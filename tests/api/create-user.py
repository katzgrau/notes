import urllib

url = 'http://localhost/notes/api/add_user/'
#url = 'http://<Site Name>/api/add_user/'

site_name = raw_input("Site Name: ")
admin_password = raw_input ("Admin Password: ")
email = raw_input("Email: ")
first_name = raw_input("First Name: ")
last_name = raw_input("Last Name: ")

u = urllib.urlopen(url, urllib.urlencode( { 'admin_password': '', 
                                            'site_name' : site_name,
											'password' : admin_password,
											'email' : email,
											'first_name' : first_name,
											'last_name' : last_name											
										  } ) )

# u is a file-like object
data = u.read()

print '*** Creating User... (create-user.py) ***'
print data
print '*** Finished Creating User... (create-user.py) ***\n\n'