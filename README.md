# bannerslider

Get customers' attention with eye-catching images

# Use

## Sliders

Each slider has a selector switch , which is currently limited to ' CUSTOM ' that allows you to create widgets to be included on the site.


It has 4 -defined styles that determine the behavior of the slider

### FlexSlider 1
![Slider Style 1](https://s32.postimg.org/k9ee2uk9d/estilo1.png)

### FlexSlider 2
![Slider Style 2](https://s32.postimg.org/3mwttrrbl/estilo2.png)

### FlexSlider 3
![Slider Style 3](https://s32.postimg.org/jvd23905t/estilo3.png)

### FlexSlider 4
![Slider Style 4](https://s32.postimg.org/cdz9aal8x/estilo4.png)

## Banners

The images that integrates an slider have effective dates so they can be displayed and / or scheduled for future viewing, helping the store manager.

Each of them can be linked to a URL that can be displayed in the indicated target.

This behavior is overridden by defining HTML content you want to display and / or configurable product that can be purchased directly from each banner.

When generating the front-end, each banner has a distinct class with the same name that was given to create the banner , allowing apply custom designs for each item from the main fears of the store.

## Install

You have to add this repository to the list defined in composer.js Magento :

```
"repositories": [
    {
        "type": "composer",
        "url": "https://repo.magento.com/"
    },
    {
        "type": "git",
        "url": "git@icebrick.pengostores.mx:Magento2/bannerslider.git",
        "reference": "master"
    }
],
```


and require it

```
"require": {
    "magento/product-community-edition": "2.0.4",
    "composer/composer": "@alpha",
    "pengo/bannerslider": "dev-master"
},
```

Depending on whether it is a new or previous installation, run:

```
composer [install][update]
```
> 
NOTE : The container must have installed git and have linked certificates with a registered account

--

**Happy coding!**
- [ivan miranda](http://ivanmiranda.me)