from flask import Flask
from flask import request
import requests
app = Flask(__name__)

@app.route('/')

def cf():

    return "Check out our cloudflare app. <a href='/cloudflare'>Cloudflare</a>"

@app.route('/cloudflare')

def cfchecker():

    output = '''<body>'''

    output += '''
    <form>
    <input name="url" placeholder="Enter The URL Please"/>
    <input type="submit"/>
    </form>
        '''

    if request.args.get('url') is not None:

        r = request.args.get('url')

        r = requests.get(r);

        r = r.headers['server']

        if(r == "cloudflare"):

            output += "CLOUDFLARE"

        else:

            output += "No Cloudflare"

    output += '''</body>'''

    return output
