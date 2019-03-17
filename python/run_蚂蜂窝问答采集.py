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
    # sql = "show tables;"
    # cursor.execute(sql)
    # tables = [cursor.fetchall()]
    # table_list = re.findall('(\'.*?\')',str(tables))
    # table_list = [re.sub("'",'',each) for each in table_list]
    # if tab_name in table_list:
    #     print('表存在')
    # else:
    #     sql = """CREATE TABLE IF NOT EXISTS `cj_mfw_wd`(
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
    sql = "SELECT * FROM cj_mfw_wd WHERE md5='"+str(md5_mm)+"'"
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
    sql = "INSERT INTO `cj_mfw_wd` (`ID`, `url`, `md5`) VALUES (NULL, '" + \
        str(url)+"', '"+str(md5_mm)+"');"
    cursor.execute(sql)
    db.commit()
    db.close()


def liebiao():
    liebiao_list = []
    pagenumber = 1
    while(pagenumber <= 20):
        url = 'http://www.mafengwo.cn/qa/ajax_qa/more?type=3&mddid=13061&tid=&sort=8&key=&page=' + \
            str(pagenumber)+'&time='
        liebiao_list.append(url)
        pagenumber = pagenumber + 1
    return liebiao_list


def single(url):
    single_list = []
    html = HTMLSession().get(url).html.html
    url_list = re.findall(r'href=\\"(\\\/wenda\\\/detail.*?)\\"', html)
    for i in url_list:
        i = re.sub(r'\\', '', i)
        url = 'http://m.mafengwo.cn'+i
        single_list.append(url)
    return single_list


def post(url):
    print(url)
    if str(chaxun_mysql(url)) == '0':
        print('不存在，开始采集')
        wp = Client('https://www.xinjiangcn.com/xmlrpc.php',
                    'admin', '12qwaszx')
        post = WordPressPost()
        post.post_status = 'draft' #publish draft
        post.custom_fields = []  # 自定义字段
        post.terms_names = {}  # 文章的分类
        post.terms_names['category'] = ['新疆旅游问答']
        post.custom_fields.append({
            'key': 'via',
            'value': url
        })

        headers = {}
        headers['User-Agent'] = 'Mozilla/5.0 (iPad; CPU OS 5_0 like Mac OS X) AppleWebKit/534.46 (KHTML, like Gecko) Version/5.1 Mobile/9A334 Safari/7534.48.3'
        html = HTMLSession().get(url,headers=headers).html

        title = html.find('h3')[0].text
        post.title = title
        print(title)

        content = ''
        ask_desc = html.find('.q-detail .desc')[0].text
        content += ask_desc

        da_list = html.find('.a-detail .bd .expand-more a')
        for i in da_list:
            da_url = 'https://m.mafengwo.cn'+ i.attrs['href']
            html = HTMLSession().get(da_url,headers=headers).html
            da_content = html.find('.ans-article')[0].html
            content += da_content + '\n\n'
        
        content = re.sub('<span.*?查看原图</span>','',content)
        content = re.sub('src="data.*?"','',content)
        content = re.sub('data-src','src',content)
        content = re.sub(r'\?imageView2.*?"','"',content)
        content = re.sub('<(div|/div|b|/b|strong|/strong).*?>','',content)

        content = re.sub(r'\n','{n}',content)
        content = re.sub(r'\s','',content)
        content = re.sub('{n}','\n',content)

        content = re.sub('<img','<img ',content)

        post.content = content

        post.id = wp.call(posts.NewPost(post))
        print("http://www.xinjiangcn.com/?p="+str(post.id))
        charu_mysql(url)
        print('\n')
    else:
        print('文章存在，跳过')


for i in liebiao():
    for i in single(i):
        post(i)