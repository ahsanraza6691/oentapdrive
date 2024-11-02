import smtplib
from email.mime.multipart import MIMEMultipart
from email.mime.text import MIMEText

# Email credentials
sender_email = "noreply@onetapdrive.com"
sender_password = "onetap1122"
recipient_email = "ahsan.ghazitech@gmail.com"

# Create message container
msg = MIMEMultipart()
msg['From'] = sender_email
msg['To'] = recipient_email
msg['Subject'] = "Test email from Python"

# Email body
body = "This is a test email sent from Python using SMTP."
msg.attach(MIMEText(body, 'plain'))

# Connect to SMTP server
smtp_server = 'smtpout.secureserver.net'
smtp_port = 465
server = smtplib.SMTP(smtp_server, smtp_port)
server.starttls()

# Login to SMTP server
server.login(sender_email, sender_password)

# Send email
server.sendmail(sender_email, recipient_email, msg.as_string())

# Close connection
server.quit()

print("Email sent successfully!")

