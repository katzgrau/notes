import urllib

#url = 'http://localhost/notes/api/send_account_expiration_emails/'
url = 'http://<Site Name>/api/send_account_expiration_emails/'

u = urllib.urlopen(url, urllib.urlencode( { 'admin_password': '', 'days' : 15 } ) )

# u is a file-like object
data = u.read()

print '*** Sending emails to accounts near expiration (send-account-expiration-emails.py) ***'
print data
print '*** Finished sending emails to accounts near expiration (send-account-expiration-emails.py) ***\n\n'