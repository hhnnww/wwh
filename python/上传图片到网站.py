from requests_html import HTML,HTMLSession

from wordpress_xmlrpc import Client, WordPressPost
from wordpress_xmlrpc.compat import xmlrpc_client
from wordpress_xmlrpc.methods import media, posts

import os
import os.path

wp = Client('https://www.xinjiangcn.com/xmlrpc.php','admin','12qwaszx')

root = 'D:\\xinjiangbizhi\\'
for parent, dirnames, filenames in os.walk(root):
    for filename in filenames:
        img_path = root+filename # 文件的完整路径

        data = {
            'name' : filename,
            'type' : 'image/jpeg'
        }

        with open(img_path, 'rb') as img:
            data['bits'] = xmlrpc_client.Binary(img.read())

        res = wp.call(media.UploadFile(data))
        print(res['url'])