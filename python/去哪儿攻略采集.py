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
        host = "127.0.0.1",
        port = 3306,
        user = 'root',
        passwd = '',
        db = 'xinjiangcn',
        charset = "utf8"
        )
    cursor = db.cursor()
    
    # 仅在第一次执行时使用
    # sql = "show tables;"
    # cursor.execute(sql)
    # tables = [cursor.fetchall()]
    # table_list = re.findall('(\'.*?\')',str(tables))
    # table_list = [re.sub("'",'',each) for each in table_list]
    # if tab_name in table_list:
    #     pass
    # else:
    #     sql = """CREATE TABLE IF NOT EXISTS `qunaer_gl`(
    #         `ID` INT UNSIGNED AUTO_INCREMENT,
    #         `url` TEXT NOT NULL,
    #         `md5` TEXT NOT NULL,
    #         PRIMARY KEY ( `ID` )
    #         )ENGINE=InnoDB DEFAULT CHARSET=utf8;"""
    #     cursor.execute(sql)

    m2 = hashlib.md5()   
    m2.update(str(url).encode("utf8"))   
    md5_mm = str(m2.hexdigest())
    md5_mm = str(md5_mm)
    sql = "SELECT * FROM qunaer_gl WHERE md5='"+str(md5_mm)+"'"
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
        host = "127.0.0.1",
        port = 3306,
        user = 'root',
        passwd = '',
        db = 'xinjiangcn',
        charset = "utf8"
        )
    cursor = db.cursor()
    m2 = hashlib.md5()   
    m2.update(str(url).encode("utf8"))   
    md5_mm = str(m2.hexdigest())
    md5_mm = str(md5_mm)
    sql = "INSERT INTO `qunaer_gl` (`ID`, `url`, `md5`) VALUES (NULL, '"+str(url)+"', '"+str(md5_mm)+"');"
    cursor.execute(sql)
    db.commit()
    db.close()

def liebiao_list():
    liebiao_list=[]
    pagenumber = 1
    while(pagenumber<=100):
        url = "https://travel.qunar.com/travelbook/list/23-xinjiang-297424/hot_heat/"+str(pagenumber)+".htm"
        liebiao_list.append(url)
        pagenumber=pagenumber+1
    return liebiao_list


def single_list(url):
    single_url_list = []
    html = HTMLSession().get(url).html
    url_list = html.find('ul.b_strategy_list li.list_item h2.tit a')
    for i in url_list:
        url = "https://travel.qunar.com"+str(i.attrs['href'])
        single_url_list.append(url)
    return single_url_list

def post_to_wp(url):
    if str(chaxun_mysql(url))=='0':
        print(url)
        wp = Client('http://www.xinjiangcn.com/xmlrpc.php', 'admin', '12qwaszx')
        post = WordPressPost()
        post.post_status = 'draft'
        post.custom_fields = [] #自定义字段
        post.terms_names = {}   #文章的分类
        post.terms_names['category'] = ['新疆游记']
        post.custom_fields.append({
            'key':'via',
            'value':url
        })
        html = HTMLSession().get(url).html
        title = html.find('.e_title h1 span.title')[0].text
        print(title)
        post.title=title

        content = ""
        content = html.find('.e_main')[0].html
        content = re.sub(r'<(h|/h|li|/li|ul|/ul|/div|div|span|/span|dl|/dl|dt|/dt|!|dd|/dd).*?>','',content)
        content = re.sub(r'(title|class|alt|data-idx|data-id|width|height|src|data-retina)=".*?"','',content)
        content = re.sub('data-original','src',content)
        content = re.sub(r'<a[\s\S]*?>.*?<\/a>','',content)
        content = re.sub(r'.jpg_r.*?"','.jpg"',content)
        content = re.sub(r'<p>图片来源于.*?<\/p>','',content)
        post.content = content

        post.id = wp.call(posts.NewPost(post))
        print("http://www.xinjiangcn.com/?p="+str(post.id))
        print('\n')
        charu_mysql(url)
    else:
        print('文章存在，跳过')

for i in liebiao_list():
    for i in single_list(i):
        post_to_wp(i)