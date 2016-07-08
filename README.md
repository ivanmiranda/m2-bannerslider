# pengo/bannerslider

## Instalación

Hay que agregar este repositorio a la lista definida en el composer.js de Magento:
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

y requerir el mismo

```
"require": {
    "magento/product-community-edition": "2.0.4",
    "composer/composer": "@alpha",
    "pengo/bannerslider": "dev-master"
},
```

Dependiendo si es una instalacion nueva o previa, ejecutar:
```
composer [install][update]
```
> NOTA: El contenedor debe tener instalado git y haber vinculado los certificados con una cuenta registrada

## Uso

### Sliders

Cada slider cuenta con un selector de posiciones, que actualmente se encuentra limitado a 'CUSTOM' que permite crear widgets para poder ser incluidos en el sitio.



![Slider Estilo 1](https://s32.postimg.org/k9ee2uk9d/estilo1.png)

![Slider Estilo 2](https://s32.postimg.org/3mwttrrbl/estilo2.png)

![Slider Estilo 3](https://s32.postimg.org/jvd23905t/estilo3.png)

![Slider Estilo 4](https://s32.postimg.org/cdz9aal8x/estilo4.png)
