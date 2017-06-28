# -*- coding: utf-8 -*-
# filename: menu.py
import urllib
from basic import Basic
accessToken=Basic().get_access_token()
print "accesstoken is :%s" % accessToken

#accessToken=Basic().test()

#ass="test is a string"

#if ass.find("test") != -1:
#   print "found"
#else:
#   print "not"



'''
#class Menu(object):
    def __init__(self):
        pass
    def create(self, postData, accessToken):
        postUrl = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=%s" % accessToken
        print "accesstoken is :%s" % accessToken
        if isinstance(postData, unicode):
            postData = postData.encode('utf-8')
        urlResp = urllib.urlopen(url=postUrl, data=postData)
        print urlResp.read()
    


if __name__ == '__main__':
    myMenu = Menu()
    myMenu.create(postJson, accessToken)
'''
