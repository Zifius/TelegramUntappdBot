import telebot

import config
import untappd_api


bot = telebot.TeleBot(config.BOT_TOKEN)


@bot.message_handler(commands=['start', 'help'])
def send_welcome(message):
    bot.reply_to(message, "Howdy, how are you doing?")


@bot.message_handler(commands=['beer'])
def echo_all(message):
    answer = untappd_api.beer_search('Dogfish 60 Minute')
    bot.send_message(message.chat.id, answer)

bot.polling()
