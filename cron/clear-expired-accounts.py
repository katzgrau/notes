import urllib

#url = 'http://localhost/notes/api/clear_expired_accounts/'
url = 'http://<Site Name>/api/clear_expired_accounts/'

u = urllib.urlopen(url, urllib.urlencode( { 'admin_password': ''} ) )

# u is a file-like object
data = u.read()

print '*** Clearing expired accounts (clear-expired-accounts.py) ***'
print data
print '*** Finished clearing expired accounts (clear-expired-accounts.py) ***\n\n'