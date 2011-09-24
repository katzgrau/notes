import urllib

url = 'http://localhost/notes/api/delete_user/'
#url = 'http://<Site Name>/api/delete_user/'

site_name = raw_input("Site Name: ")

u = urllib.urlopen(url, urllib.urlencode( { 'admin_password': '', 
                                            'site_name' : site_name } ) )

# u is a file-like object
data = u.read()

print '*** Deleting User... (delete-user.py) ***'
print data
print '*** Finished Deleting User... (delete-user.py) ***\n\n'