from requests_html import HTMLSession
import re
from tomorrow3 import threads

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
        url = re.sub(r'\/(\d+)\.html',r'/list_\g<1>.html',url)
        single_list.append(url)
    return single_list

@threads(5)
def save_img(url):
    html = HTMLSession().get(url).html
    img_list = html.find('.picMain .picture .picFrame .pic img')
    
    for i in img_list:
        img_url = 'https:'+str(i.attrs['src'])
        img_url = re.sub('_mthumb','',img_url)
        print(img_url)

        img_name = re.findall(r'\/(\d+_\d+)\.jpg',img_url)[0]
        print(img_name)

        bit = HTMLSession().get(img_url).content

        f = open('D:\\新疆素材\\pconline\\'+str(img_name)+'.jpg','wb')
        f.write(bit)
        f.close

for i in liebiao_list():
    for i in single_list(i):
        save_img(i)