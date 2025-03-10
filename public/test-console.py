import sys
import json
import requests
import base64

username = "Monty Dhanda"
application_password = "Ocxq 6E3x mvJs zDvp UuoD vnnM"
credentials = f"{username}:{application_password}"
encoded_credentials = base64.b64encode(credentials.encode()).decode()

headers = {
    'Accept': 'application/json, */*;q=0.1',
    'Authorization': f"Basic {encoded_credentials}",
    'User-Agent': 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.4 Safari/605.1.15',
    'Connection': 'keep-alive',
}

params = {
    'startDate': '2024-09-02',
    'endDate': '2024-09-02',
    'dimensions': 'query, page, country, device, date',
    'limit': '1',
    'startRow': '10'
}

response = requests.get('https://www.wikilistia.com/wp-json/botxbyte/v1/search-console-data', params=params, headers=headers)

print(response.json())
print(len(response.json()))


params = {
    'startDate': '2023-08-01',
    'endDate': '2024-08-31',
    'metrics': 'activeUsers,newUsers,averageSessionDuration',
    'dimensions': 'date,pagePath',
    'limit': '2500000',  
}

response = requests.get('https://www.wikilistia.com/wp-json/botxbyte/v1/analytics-data', params=params, headers=headers)

print(json.dumps(response.json()))
print(len(response.json()['rows']))