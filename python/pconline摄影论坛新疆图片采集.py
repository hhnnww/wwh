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
    while(pagenumber<=240):
        url = 'https://dp.pconline.com.cn/public/tools/search.jsp?keyword=%D0%C2%BD%AE&time=1095&type=photoTitle&pageNo='+str(pagenumber)
        liebiao_list.append(url)
        pagenumber=pagenumber+1
    return liebiao_list

def single_list(url):
    single_list = []
    html = HTMLSession().get(url).html
    sing_url = html.find('ul.resultList li.item .con a.pic-url')
    for i in sing_url:
        url = 'https:'+ str(i.attrs['href'])
        url = re.sub(r'\/(\d+)\.html','/list_{1}.html',url)
        single_list.append(url)
    return single_list
    
for i in single_list('https://dp.pconline.com.cn/public/tools/search.jsp?keyword=%D0%C2%BD%AE&time=1095&type=photoTitle&pageNo=1'):
    print(i)
    
