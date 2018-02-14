# Placeholder Pixel plugin for Craft CMS 3.x

Create a base64-encoded transparent pixel of the given width and height

Pixels once generated are cached on a width * height basis to reduce load

## Requirements

This plugin requires Craft CMS 3.0.0-beta.23 or later.

## Installation

To install the plugin, follow these instructions.

1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Then tell Composer to load the plugin:

        composer require tibemolde/placeholder-pixel

3. In the Control Panel, go to Settings → Plugins and click the “Install” button for Placeholder Pixel.

## Placeholder Pixel Overview

Create a base64-encoded transparent pixel of the given width and height

## Configuring Placeholder Pixel

No configuration is needed outside of runtime-options

## Using Placeholder Pixel

Base usage:

    craft.placeholderPixel.get(options)
    
Default options:

    {
        width       : 1,
        height      : 1,
        aspectRatio : {
            w: 16,
            h: 10
        }
    }    
    
Examples:

1.  1 x 1 pixel:

        <img src="{{ craft.placeholderPixel.get }}" alt="">

2. Pixel with two specific dimensions:

        <img src="{{ craft.placeholderPixel.get({width: 64, height: 64}) }}" alt="">
        
3. Pixel with one specific dimension and default aspect-ratio:

        <img src="{{ craft.placeholderPixel.get({width: 1024}) }}" alt="">
    
4. Pixel with one specific dimension and specific aspect-ratio:

        <img src="{{ craft.placeholderPixel.get({width: 1024, aspectRatio: {w: 5, h: 4}}) }}" alt="">

## Placeholder Pixel Roadmap

Some things to do, and ideas for potential features:

* Register it on packagist
* Release it

Brought to you by [TIBE Molde](https://github.com/tibemolde)
