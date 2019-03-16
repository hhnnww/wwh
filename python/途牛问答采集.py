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

def liebiao_list():
    liebiao_list = []
    pagenumber = 1
    while(pagenumber<100):
        url = 'https://www.tuniu.com/papi/wenda/index/getHomeQaFromEs?d={"pageSize":20,"pageNumber":'+str(pagenumber)+',"cityCode":3100,"tags":[],"timestamp":1552707708708}&c={"ct":100}&_=1552707847245'
        liebiao_list.append(url)
        pagenumber=pagenumber+1
    return liebiao_list

def single_list(url):
    single_url_list = []
    html = HTMLSession().get(url).html.html
    url_list = re.findall(r'"detailUrl":"([\s\S]+?)"',html)
    for url in url_list:
        url_id = re.findall(r'detail\/(\d+)',url)[0]
        url = 'http://www.tuniu.com/wenda/detail-'+str(url_id)
        single_url_list.append(url)
    return single_url_list

def creat_mysql():
    db = pymysql.connect(
        host = "127.0.0.1",
        port = 3306,
        user = 'root',
        passwd = '',
        db = 'xinjiangcn',
        charset = "utf8"
        )
    cursor = db.cursor()
    sql = "show tables;"
    cursor.execute(sql)
    tables = [cursor.fetchall()]
    table_list = re.findall('(\'.*?\')',str(tables))
    table_list = [re.sub("'",'',each) for each in table_list]
    if 'tuniu' in table_list:
        print('途牛存在')
    else:
        sql = """CREATE TABLE IF NOT EXISTS `tuniu`(
            `ID` INT UNSIGNED AUTO_INCREMENT,
            `url` TEXT NOT NULL,
            `md5` TEXT NOT NULL,
            PRIMARY KEY ( `ID` )
            )ENGINE=InnoDB DEFAULT CHARSET=utf8;"""
        cursor.execute(sql)
    db.close()

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
    m2 = hashlib.md5()   
    m2.update(str(url).encode("utf8"))   
    md5_mm = str(m2.hexdigest())
    md5_mm = str(md5_mm)
    sql = "SELECT * FROM tuniu WHERE md5='"+str(md5_mm)+"'"
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
    sql = "INSERT INTO `tuniu` (`ID`, `url`, `md5`) VALUES (NULL, '"+str(url)+"', '"+str(md5_mm)+"');"
    cursor.execute(sql)
    db.commit()
    db.close()

def post_to_wp(url):
    if str(chaxun_mysql(url))=='0':
        print('不存在')
        wp = Client('https://www.xinjiangcn.com/xmlrpc.php', 'admin', '12qwaszx')
        post = WordPressPost()
        post.post_status = 'draft'
        post.custom_fields = [] #自定义字段
        post.terms_names = {}   #文章的分类
        post.terms_names['category'] = ['新疆旅游问答']
        post.custom_fields.append({
            'key':'via',
            'value':url
        })
        html = HTMLSession().get(url).html
        title = html.find('.wenda-question .title h2')[0].text
        print(title)
        post.title = title
        content = ''
        content_list = html.find('li.item .col-2-bd')
        for i in content_list:
            content = content + str(i.html) + '\n\n'
        content = re.sub('<(/div|div|span|/span).*?>','',content)
        content = re.sub('(class|alt)=".*?"','',content)
        content = re.sub('\n','\n\n',content)
        post.content = content
        post.id = wp.call(posts.NewPost(post))
        print("http://www.xinjiangcn.com/?p="+str(post.id))
        charu_mysql(url)
    else:
        print('文章存在，跳过')

for i in liebiao_list():
    for s in single_list(i):
        post_to_wp(s)