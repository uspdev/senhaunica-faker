from requests_oauthlib import OAuth1Session
import getpass
import json
import requests

# based on: https://requests-oauthlib.readthedocs.io/en/latest/oauth1_workflow.html
# MUST fill client_key, client_secret and callback_id
client_key = ''
client_secret = ''
callback_id = 0
user = ''
passwd = ''

# request_token
request_token_url = "https://uspdigital.usp.br/wsusuario/oauth/request_token"
oauth = OAuth1Session(client_key, client_secret=client_secret)
response = oauth.fetch_request_token(request_token_url)
resource_owner_key = response.get('oauth_token')
resource_owner_secret = response.get('oauth_token_secret')

# authorize
base_authorization_url = "https://uspdigital.usp.br/wsusuario/oauth/authorize"
authorization_url = oauth.authorization_url(base_authorization_url)+"&callback_id="+str(callback_id)
if (not user):
    user = input("NUSP: ")
if (not passwd):
    passwd = getpass.getpass()
payload = {
    'loginUsuario': user,
    'senhaUsuario': passwd, 
    'oauth_token': resource_owner_key,
    'callback_id': callback_id
}
redirect_response = requests.post(authorization_url, data=payload)
response = oauth.parse_authorization_response(redirect_response.url)
verifier = response.get('oauth_verifier')

# access_token
access_token_url = "https://uspdigital.usp.br/wsusuario/oauth/access_token"
oauth = OAuth1Session(client_key,
                      client_secret=client_secret,
                      resource_owner_key=resource_owner_key,
                      resource_owner_secret=resource_owner_secret,
                      verifier=verifier)
final_tokens = oauth.fetch_access_token(access_token_url)
resource_owner_key = final_tokens.get('oauth_token')
resource_owner_secret = final_tokens.get('oauth_token_secret')

# usuariousp
url = "https://uspdigital.usp.br/wsusuario/oauth/usuariousp"
oauth = OAuth1Session(client_key,
                      client_secret=client_secret,
                      resource_owner_key=resource_owner_key,
                      resource_owner_secret=resource_owner_secret)
response = oauth.post(url)
user = json.loads(response.text)
print(user)
