from requests_html import HTMLSession
import re

def htmldown(url):
    session = HTMLSession()
    html = session.get(url).html
    return html

def url_list():
    html = htmldown('http://www.win4000.com/zt/xinjiang.html')
    html = html.find('.w1180')[0].find('ul.clearfix')[0].find('li')
    url_list = []
    for i in html:
        url = i.find('a')[0].attrs['href']
        url_list.append(url)
    return url_list

def jiexi(url):
    html = htmldown(url)
    html = html.find('.scroll-img-cont')[0].find('li')
    img_list = []
    for i in html:
        img = i.find('img')[0].attrs['data-original']
        img = re.sub('_120_80','',img)
        img_list.append(img)
    return img_list

def all_img():
    all_img = []
    for i in url_list():
        for i in jiexi(i):
            all_img.append(i)
    return all_img

def run():
    x = 1
    for i in all_img():
        bit = HTMLSession().get(i).content
        f = open('D:/xinjiangbizhi/'+str(x)+'.jpg','wb')
        f.write(bit)
        f.close
        x = x+1

# run()