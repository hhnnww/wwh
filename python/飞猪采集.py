from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.support.wait import WebDriverWait

from requests_html import HTML,HTMLSession

from wordpress_xmlrpc import Client, WordPressPost
from wordpress_xmlrpc.compat import xmlrpc_client
from wordpress_xmlrpc.methods import media, posts

import time
import re

import PyMysql

def htmldown(url):
    brower = webdriver.Chrome()
    brower.set_window_size(300,800)
    brower.get(url)

    js = "document.documentElement.scrollTop=10000"
    brower.execute_script(js)
    time.sleep(2)

    js = "document.documentElement.scrollTop=10000"
    brower.execute_script(js)
    time.sleep(2)
  
    html = brower.page_source
    html = HTML(html=html)
    return html

def fabu(url):
    html = htmldown(url)
    base_url = 'https://www.xinjiangcn.com/'
    wp = Client(str(base_url)+'xmlrpc.php', 'admin', '12qwaszx')
    post = WordPressPost()
    post.post_status = 'draft'
    post.custom_fields = []
    post.terms_names = {
        'category': ['线路']
    }

    url_id = re.findall(r'id=([\d]+)',url)[0]
    url = 'https://traveldetail.fliggy.com/item.htm?id='+str(url_id)
    post.custom_fields.append({
        'key':'via',
        'value':url
    })

    title = html.find('.title span')[0].text
    post.title = title

    # 价格
    price = html.find('.price-wrapper .price-area span.price-str span')[0].text
    # price = re.sub('.*?-','',price)
    post.custom_fields.append({
        'key':'price',
        'value':price
    })

    # 卖点
    maidian = html.find('.mod-highlight')[0].find('ul')[0]
    maidian = maidian.find('li')
    maidian_all = ''
    for i in maidian:
        maidian = i.text
        maidian_all = maidian_all  + maidian + '\n'

    post.custom_fields.append({
        'key':'maidian',
        'value':maidian_all
    })

    # 出发地
    chufadi = html.find('.mod-tabular-list .content')[0].find('.item .info')[0].text
    chufadi = re.sub('、','，',chufadi)
    post.custom_fields.append({
        'key':'chufadi',
        'value':chufadi
    })

    # 目的地
    mudidi = html.find('.mod-tabular-list .content')[0].find('.item .info')[1].text
    mudidi = re.sub('、','，',mudidi)
    post.custom_fields.append({
        'key':'mudidi',
        'value':mudidi
    })

    # 购物
    gouwu = html.find('.mod-tabular-list .content')[0].find('.item .info')[2].text
    gouwu = re.sub('、','，',gouwu)
    post.custom_fields.append({
        'key':'gouwu',
        'value':gouwu
    })

    # 天数
    tianshu = html.find('.mod-tabular-list .content')[0].find('.item .info')[3].text
    tianshu = re.sub('、','，',tianshu)
    post.custom_fields.append({
        'key':'tianshu',
        'value':tianshu
    })

    # 玩法
    wanfa = html.find('.mod-tabular-list .content')[0].find('.item .info')[4].text
    wanfa = re.sub('、','，',wanfa)
    post.custom_fields.append({
        'key':'wanfa',
        'value':wanfa
    })

    # 交通
    try:
        jiaotong = html.find('.mod-tabular-list .content')[0].find('.item .info')[5].text
    except IndexError:
        jiaotong = ''
    else:
        jiaotong = html.find('.mod-tabular-list .content')[0].find('.item .info')[5].text
        jiaotong = re.sub('、','，',jiaotong)
    post.custom_fields.append({
        'key':'jiaotong',
        'value':jiaotong
    })

    # 行程
    xc_all = []
    fz_xc = html.find('.mod-traveldetail-detailed')
    for i in fz_xc:
        fz_xc = i.find('.traveldetail-content')[0]

        title = fz_xc.find('.traveldetail-content-item')[0].find('.mod-travellistdetailed-item')[0].text
        title = re.sub(r'第.*?天:','',title)

        can = fz_xc.find('.traveldetail-content-item')[1].find('.title')[0].text

        try:
            zhu = fz_xc.find('.traveldetail-content-item')[2].find('.title')[0].text
        except IndexError:
            zhu = '无'
        else:
            zhu = fz_xc.find('.traveldetail-content-item')[2].find('.title')[0].text

        xc_one = {
            'title':title,
            'can':can,
            'zhu':zhu
        }

        xc_all.append(xc_one)

    post.custom_fields.append({
        'key':'xc',
        'value':xc_all
    })

    # 费用包含
    baohan = html.find('.mod-feeinclude .item-cnt')[0].text
    post.custom_fields.append({
        'key':'baohan',
        'value':baohan
    })

    # 费用不包含
    bubaohan = html.find('.mod-feeinclude .item-cnt')[1].text
    post.custom_fields.append({
        'key':'bubaohan',
        'value':bubaohan
    })

    # 自费项目
    try:
        html.find('.mod-feeinclude .item-cnt')[2].text
    except IndexError:
        zifei = '无'
    else:
        zifei = html.find('.mod-feeinclude .item-cnt')[2].text
    post.custom_fields.append({
        'key':'zifei',
        'value':zifei
    })

    # 预订须知
    xuzhi = html.find('.mod-notice .item-cnt')[0].text
    post.custom_fields.append({
        'key':'xuzhi',
        'value':xuzhi
    })
    
    post.id = wp.call(posts.NewPost(post))
    print(str(base_url)+'?p='+str(post.id))



url = input('输入页面地址：')
id = re.findall(r'id=([\d]+)',url)[0]
url = 'https://h5.m.taobao.com/trip/travel-detail/index/index.html?id='+str(id)
fabu(url)