import urllib

url = 'http://localhost/notes/api/send_emails/'
#url = 'http://<Site Name>/api/send_emails/'

u = urllib.urlopen(url, urllib.urlencode( { 'admin_password': '' } ) )

# u is a file-like object
data = u.read()

print '*** Sending Emails (send-emails.py) ***'
print data
print '*** Finished Sending Emails (send-emails.py) ***\n\n'