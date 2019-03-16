from requests_html import HTMLSession
import re
from wordpress_xmlrpc import Client, WordPressPost
from wordpress_xmlrpc.compat import xmlrpc_client
from wordpress_xmlrpc.methods import media, posts
from urllib.parse import quote
from tomorrow3 import threads

base_url = 'https://www.tulelx.com/'
wp = Client(str(base_url)+'xmlrpc.php', 'admin', '111')
post = WordPressPost()
post.post_status = 'publish'

post.terms_names = {
    'category': ['问答']
}


def htmldown(url):
    session = HTMLSession()
    html = session.get(url).html
    return html

def fabu(url):

    post.custom_fields = []
    post.custom_fields.append({
        'key': 'via',
        'value': url,
    })

    html = htmldown(url)
    title = html.find('span.ask-title', first=True).text
    post.title = title
    print(title)

    content = html.find('.best-text ', first=True).html
    content = re.sub('<(/div|div|span|/span).*?>','',content)
    content = re.sub('展开全部','',content)
    content = re.sub('(class|esrc)=".*?"','',content)
    content = re.sub('<(a|/a).*?>','',content)
    content = re.sub('   ',' ',content)
    content = re.sub('\n','',content)
    post.content = content
    # print(content)

    # 添加特色图
    try:
        html.find('.wgt-ask .q-img-wp img.q-img-item', first=True).attrs['src']
    except AttributeError:
        post.thumbnail = None
    else:
        img = html.find('img.q-img-item', first=True).attrs['src']
        img = HTMLSession().get(img).content
        data = {'name': 'xinjiangcn_pic.jpg', 'type': 'image/jpeg'}
        data['bits'] = xmlrpc_client.Binary(img)
        response = wp.call(media.UploadFile(data))
        post.custom_fields.append({
            'key':'st',
            'value':[response['id']]
        })

    post.id = wp.call(posts.NewPost(post))  # 返回文章ID
    print(str(base_url)+'?p='+str(post.id))

def start():
    keywords = ['旅游']
    keyword_list = []
    for keyword in keywords:
        keyword = keyword.encode('GBK', 'replace')  # 转换为GBK
        keyword = quote(keyword)  # 进行url编码
        keyword_list.append(keyword)
    return keyword_list

def run(keyword):
    # 文章计数
    max_page = 760
    num = 1
    x = 0
    while(x < max_page):
        page_url = ('https://zhidao.baidu.com/search?word=' +
                    str(keyword)+'&ie=gbk&site=-1&sites=0&date=0&pn='+str(x))
        html = htmldown(page_url)
        links = html.find('a.ti')
        for i in links:
            url = i.attrs['href']
            if 'zhidao' in url:
                try:
                    fabu(url)
                    num = num + 1
                    print('\n')
                except:
                    pass
        x = x + 10


for keyword in start():
    run(keyword)