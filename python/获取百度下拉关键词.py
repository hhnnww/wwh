import requests
import json
import ssl

ssl._create_default_https_context = ssl._create_unverified_context

def get_sug(word):
    url = 'https://sp0.baidu.com/5a1Fazu8AA54nxGko9WTAnF6hhy/su?wd=%s&sugmode=2&json=1&p=3&sid=1427_21091_21673_22581&req=2&pbs=%%E5%%BF%%AB%%E6%%89%%8B&csor=2&pwd=%%E5%%BF%%AB%%E6%%89%%8B&cb=jQuery11020924966752020363_1498055470768&_=1498055470781' % word
    r = requests.get(url)
    cont = r.content
    res = cont[41: -2].decode('gbk')
    res_json = json.loads(res)
    return res_json['s']

def get_most_sug(word):
    all_words = []
    for i in 'abcdefghijklmnopqrstuvwxyz': 
        for j in 'abcdefghijklmnopqrstuvwxyz': 
            all_words += get_sug(word+i+j)
    return list(set(all_words))

print('\n'.join(get_most_sug('新疆 旅游')))