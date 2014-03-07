#!/bin/bash

echo 'After script'

echo 'Installing gems...'
bundle install --gemfile=/vagrant/Gemfile
rbenv rehash