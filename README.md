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

# Uso

## Sliders

Cada slider cuenta con un selector de posiciones, que actualmente se encuentra limitado a 'CUSTOM' que permite crear widgets para poder ser incluidos en el sitio.

Se cuenta con 4 estilos definidos que determinan el comportamiento del slider

### FlexSlider 1
![Slider Estilo 1](https://s32.postimg.org/k9ee2uk9d/estilo1.png)

### FlexSlider 2
![Slider Estilo 2](https://s32.postimg.org/3mwttrrbl/estilo2.png)

### FlexSlider 3
![Slider Estilo 3](https://s32.postimg.org/jvd23905t/estilo3.png)

### FlexSlider 4
![Slider Estilo 4](https://s32.postimg.org/cdz9aal8x/estilo4.png)

## Banners

Las imagenes que componen el slider cuentan con fechas de vigencia para que puedan ser mostradas y/o programadas para visualización futura, ayudando así al administrador de la tienda.

Cada una de ellas se puede vincular a una URL que se puede mostrar en el target indicado.

Este comportamiento se sobreescribe al definir contenido HTML que se deseé desplegar y/o el producto configurable que se puede comprar directamente desde cada banner.

Al generar el front-end, cada banner tiene una clase distintiva con el mismo nombre que se dió al crear el banner, permitiendo así aplicar diseños personalizados para cada elemento desde el teme principal de la tienda.

**Happy coding!**
- [ivan miranda](http://ivanmiranda.me)