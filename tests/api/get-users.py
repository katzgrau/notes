import urllib

#url = 'http://localhost/notes/api/get_user_list/'
url = 'http://tjes.<Site Name>/api/get_user_list/'

u = urllib.urlopen(url, urllib.urlencode( { 'admin_password': '' } ) )

# u is a file-like object
data = u.read()

print '*** Gettings Users... (get-users.py) ***'
print data
print '*** Finished Getting Users... (get-users.py) ***\n\n'