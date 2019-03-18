from requests_html import HTMLSession

from wordpress_xmlrpc import Client, WordPressPost
from wordpress_xmlrpc.methods.posts import GetPosts, NewPost
from wordpress_xmlrpc.methods.users import GetUserInfo
from wordpress_xmlrpc.methods import posts
from wordpress_xmlrpc.methods import taxonomies
from wordpress_xmlrpc import WordPressTerm
from wordpress_xmlrpc.compat import xmlrpc_client
from wordpress_xmlrpc.methods import media, posts

import re
import pymysql
import hashlib

from textrank4zh import TextRank4Keyword, TextRank4Sentence

def chaxun_mysql(url):
    db = pymysql.connect(
        host="127.0.0.1",
        port=3306,
        user='root',
        passwd='',
        db='xinjiangcn',
        charset="utf8"
    )
    cursor = db.cursor()

    # 仅在第一次执行时使用
    # tab_name = 'dazijia'
    # sql = "show tables;"
    # cursor.execute(sql)
    # tables = [cursor.fetchall()]
    # table_list = re.findall('(\'.*?\')',str(tables))
    # table_list = [re.sub("'",'',each) for each in table_list]
    # if tab_name in table_list:
    #     print('表存在')
    # else:
    #     sql = """CREATE TABLE IF NOT EXISTS `"""+tab_name+"""`(
    #         `ID` INT UNSIGNED AUTO_INCREMENT,
    #         `url` TEXT NOT NULL,
    #         `md5` TEXT NOT NULL,
    #         PRIMARY KEY ( `ID` )
    #         )ENGINE=InnoDB DEFAULT CHARSET=utf8;"""
    #     cursor.execute(sql)
    #     print('新建表成功')

    m2 = hashlib.md5()
    m2.update(str(url).encode("utf8"))
    md5_mm = str(m2.hexdigest())
    md5_mm = str(md5_mm)
    sql = "SELECT * FROM dazijia WHERE md5='"+str(md5_mm)+"'"
    cursor.execute(sql)
    res = cursor.fetchall()
    db.commit()
    if len(res):
        cx_res = '1'
    else:
        cx_res = '0'
    db.close()
    return cx_res


def charu_mysql(url):
    db = pymysql.connect(
        host="127.0.0.1",
        port=3306,
        user='root',
        passwd='',
        db='xinjiangcn',
        charset="utf8"
    )
    cursor = db.cursor()
    m2 = hashlib.md5()
    m2.update(str(url).encode("utf8"))
    md5_mm = str(m2.hexdigest())
    md5_mm = str(md5_mm)
    sql = "INSERT INTO `dazijia` (`ID`, `url`, `md5`) VALUES (NULL, '" + \
        str(url)+"', '"+str(md5_mm)+"');"
    cursor.execute(sql)
    db.commit()
    db.close()


def liebiao_list():
    liebiao_list = []
    pagenumber = 1
    while(pagenumber <= 21):
        url = 'http://www.dazijia.com/gonglue/xinjiang.html?p='+str(pagenumber)
        pagenumber = pagenumber+1
        liebiao_list.append(url)
    return liebiao_list


def single_list(url):
    single_url_list = []
    html = HTMLSession().get(url).html
    url_list = html.find('.gl-list .gl-item>ul li a')
    for i in url_list:
        url = i.absolute_links
        for i in url:
            single_url_list.append(i)
    return single_url_list


def post_to_wp(url):
    print(url)
    if str(chaxun_mysql(url)) == '1':
        print('不存在，开始采集')
        wp = Client('https://www.xinjiangcn.com/xmlrpc.php',
                    'admin', '12qwaszx')
        post = WordPressPost()
        post.post_status = 'draft'
        post.custom_fields = []  # 自定义字段
        post.terms_names = {}  # 文章的分类
        post.terms_names['category'] = ['新疆旅游攻略']
        post.custom_fields.append({
            'key': 'via',
            'value': url
        })

        html = HTMLSession().get(url).html

        title = html.find('h1')[0].text
        print(title)
        post.title = title

        content = html.find('.gl-content #copy')[0].html
        content = re.sub('<(/div|div|span|/span).*?>', '', content)
        content = re.sub('(class|alt|id)=".*?"', '', content)
        content = re.sub('data-original', 'src', content)
        content = re.sub('<h[0-9]+.*?>', '<h2>', content)
        content = re.sub('(	)', '', content)
        content = re.sub(r'(\!\/.*?)"', '"', content)

        text = re.sub('<.*?>','',content)
        text = re.sub(r'\s','',text)
        
        zy = ''
        tr4s = TextRank4Sentence()
        tr4s.analyze(text=text, lower=True, source = 'all_filters')
        for item in tr4s.get_key_sentences(num=50):
            zy = zy + item.sentence
        
        tag = []
        tr4w = TextRank4Keyword()
        tr4w.analyze(text=text, lower=True, window=2)
        
        for item in tr4w.get_keywords(20, word_min_len=3):
            tag.append(item.word)
            

        post.content = zy + '\n\n' + content

        # post.id = wp.call(posts.NewPost(post))
        # print("http://www.xinjiangcn.com/?p="+str(post.id))
        # charu_mysql(url)

        print('\n')
    else:
        print('文章存在，跳过')


for i in liebiao_list():
    for x in single_list(i):
        post_to_wp(x)
