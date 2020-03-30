#!/usr/bin/python3
# -*- coding: utf-8 -*-
"""
Created on Mon Mar 30 11:03:22 2020

generic email generator
from an example by  Arjun Krishna Babu
at
https://www.freecodecamp.org/news/send-emails-using-code-4fcea9df63f/
tweaks for coronacircles by: christopherrehm@web.de
"""
# Function to read the contacts from a given contact file and return a
# list of names and email addresses
import smtplib

from string import Template

from email.mime.multipart import MIMEMultipart
from email.mime.text import MIMEText

MY_ADDRESS = 'admin_no_reply@coronacircles.net'
PASSWORD = 'G79kCU-ahgnB%N#'


def get_contacts(filename):
    """
    Return two lists names, emails containing names and email addresses
    read from a file specified by filename.
    """

    names = []
    emails = []
    with open(filename, mode='r', encoding='utf-8') as contacts_file:
        for a_contact in contacts_file:
            names.append(a_contact.split()[0])
            emails.append(a_contact.split()[1])
    return names, emails


def read_template(filename):
    """
    Returns a Template object comprising the contents of the
    file specified by filename.
    """

    with open(filename, 'r', encoding='utf-8') as template_file:
        template_file_content = template_file.read()
    return Template(template_file_content)


def main(emailList, message):  # expects 2 lists from text files to build email
    names, emails = get_contacts(emailList)  # read contacts
    message_template = read_template(message)

    # set up the SMTP server
    s = smtplib.SMTP(host='	smtp.strato.de', port=465)
    s.starttls()
    s.login(MY_ADDRESS, PASSWORD)

    # For each contact, send the email:
    for name, email in zip(names, emails):
        msg = MIMEMultipart()       # create a message

        # add in the actual person name to the message template
        message = message_template.substitute(PERSON_NAME=name.title())

        # Prints out the message body for our sake
        print(message)

        # setup the parameters of the message
        msg['From'] = MY_ADDRESS
        msg['To'] = email
        msg['Subject'] = "This is TEST"

        # add in the message body
        msg.attach(MIMEText(message, 'plain'))

        # send the message via the server set up earlier.
        s.send_message(msg)
        del msg

    # Terminate the SMTP session and close the connection
    s.quit()


if __name__ == '__main__':
    main()