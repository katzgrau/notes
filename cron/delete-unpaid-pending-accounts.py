import urllib

#url = 'http://localhost/notes/api/clear_unpaid_pending_accounts/'
url = 'http://<Site Name>/api/clear_unpaid_pending_accounts/'

u = urllib.urlopen(url, urllib.urlencode( { 'admin_password': '' } ) )

# u is a file-like object
data = u.read()

print '*** Deleting upaid pending accounts (delete-unpaid-pending-accounts.py) ***'
print data
print '*** Finished deleting upaid pending accounts (delete-unpaid-pending-accounts.py) ***\n\n'