import urllib

url = 'http://localhost/notes/api/process_uploads/'
#url = 'http://<Site Name>/api/send_emails/'

u = urllib.urlopen(url, urllib.urlencode( { 'admin_password': '' } ) )

# u is a file-like object
data = u.read()

print '*** Processing Uploads (process-uploads.py) ***'
print data
print '*** Finished Processing Uploads (process-uploads.py) ***\n\n'