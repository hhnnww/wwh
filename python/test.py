from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.support.wait import WebDriverWait
import time

def htmldown(url):
    brower = webdriver.Chrome()
    brower.set_window_size(300,800)
    brower.get(url)

    js = "document.documentElement.scrollTop=1000"
    brower.execute_script(js)
    WebDriverWait(brower,2)


    js = "document.documentElement.scrollTop=1000"
    brower.execute_script(js)
    WebDriverWait(brower,2)

    js = "document.documentElement.scrollTop=1000"
    brower.execute_script(js)
    WebDriverWait(brower,2)

    btn = brower.find_elements_by_css_selector('.desc-wrap .fold-btn .text')
    for i in btn:
        i.click()

url = 'https://h5.m.taobao.com/trip/travel-detail/index/index.html?spm=a1z10.1-b.w4004-4891720451.2.3c812665EgsJVH&id=37258139518&userBucket=9&_projVer=0.3.196'
htmldown(url)