Composer NEON Plugin
====================

[![Packagist](https://img.shields.io/packagist/v/webuni/composer-neon-plugin.svg?style=flat-square)](https://packagist.org/packages/webuni/composer-neon-plugin)
[![Build Status](https://travis-ci.org/webuni/composer-neon-plugin.svg?branch=master)](https://travis-ci.org/webuni/composer-neon-plugin)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/webuni/composer-neon-plugin/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/webuni/composer-neon-plugin/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/webuni/composer-neon-plugin/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/webuni/composer-neon-plugin/?branch=master)
[![SensioLabsInsight](https://img.shields.io/sensiolabs/i/f0a7af27-8bdf-4213-ac0a-22eeea91f3f6.svg?style=flat-square)](https://insight.sensiolabs.com/projects/f0a7af27-8bdf-4213-ac0a-22eeea91f3f6)

This plugin allows you to convert a composer.neon file into composer.json format.
It will use those exact filenames of your current working directory.

Warning: If you already have a composer.json file, it will overwrite it.

Installation
------------

    composer global require webuni/composer-neon-plugin 

Usage
-----

To convert from neon (`composer.neon`) to json (`composer.json`), run:

    $ composer neon-convert

To convert from json to neon, run:

    $ composer neon-convert composer.json

Alternatives
------------

- https://github.com/webuni/composer-yaml-plugin

License
-------

MIT License. See the LICENSE file.
