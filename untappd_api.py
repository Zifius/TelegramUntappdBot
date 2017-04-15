import requests
from config import CLIENT_ID, CLIENT_SECRET

api_url = 'https://api.untappd.com/v4/'


def beer_search(beer_query):
    search_results = requests.get(
        '{0}search/beer?client_id={1}&client_secret={2}&q={3}'.format(api_url, CLIENT_ID, CLIENT_SECRET,
                                                                      beer_query)).json()

    # some response just for testing purposes
    beers = search_results['response']['beers']['items']
    first_beer = beers[0]
    first_beer_name = first_beer['beer']['beer_name']

    return first_beer_name
