import urllib
import urllib2
import time
import json
import os
#import pylibmc as memcache
import pylibmc
          

#mc = pylibmc.Client(["127.0.0.1"],binary=True,behaviors={"tcp_nodelay":True,"ketama":True})
#mc = pylibmc.Client(['127.0.0.1:11211','127.0.0.1:11212'])
#mc.set("token","")
#mc["token"] = ''
#token = mc.get("token")

class Basic:
      def __init__(self):
          self.__accessToken =''
          self.__leftTime = 0
      def __real_get_access_token(self):
          appId ="wx83d36ec5c1b700a3"
          appSecret = "8f7d9b2f72d86a67606c323b845bd93c"

          postUrl = ("https://api.weixin.qq.com/cgi-bin/token?grant_type="
                 "client_credential&appid=%s&secret=%s" % (appId,appSecret))

          urlResp = urllib.urlopen(postUrl)
          urlResp = json.loads(urlResp.read())

          self.__accessToken = urlResp['access_token']
          self.__leftTime = urlResp['expires_in']
              
          file_object=open('tokenfile.txt','w')
          file_object.write(self.__accessToken)
          file_object.close()

          print "now gettoken is %s" % self.__leftTime

      def get_access_token(self):
          #print "selfleft is %s" % self.__leftTime

                                     #if self.__leftTime <10:
                                     #   self.__real_get_access_token()
                                     #if self.__accessToken == '':
          #   self.__real_get_access_token()
                                     #mc.set("token",self.__accessToken,7200)
                                     #self.__accessToken = mc.get("token")         
          #else:
          #   print "same invoke detected"
          filename = r'tokenfile.txt' 
          if (os.path.exists(filename)):
              print "file exists"
              file_object=open('tokenfile.txt','r')
              self.__accessToken = file_object.read()
              print "the ##is :%s" % self.__accessToken
              file_object.close()
          else:
              print "no file"
              self.__real_get_access_token()
         

          return self.__accessToken
          #return token

           


      def run(self):
          while(True):
              if self.__leftTime >10:
                 time.sleep(2)
                 self.__leftTime -= 2
              else:
                 self.__real_get_access_token()
