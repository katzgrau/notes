import urllib

#url = 'http://localhost/notes/api/send_usage_report/'
url = 'http://<Site Name>/api/send_usage_report/'

u = urllib.urlopen(url, urllib.urlencode( { 'admin_password': '' } ) )

# u is a file-like object
data = u.read()

print '*** Sending usage report... (send-usage-report.py) ***'
print data
print '*** Finished sending usage report... (send-usage-report.py) ***\n\n'