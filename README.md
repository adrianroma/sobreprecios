# sobreprecios

Modulo Simple : Modulo que controla el precio del producto agregando sobreprecio al precio original y tiene posiblidad de reestablecer el precio original  

1.- Crea la tabla donde se almacenan solo los valores de sku ,precio, precio original , sobre precio , coto envio  asi como su fecha de creacion y actualizacion

2.- Genara el grid que esta disponible en el menu de configuracion 

3.- En este grid se puede ver sl sku y las columnas necesarias para ver los precios ,sobre precio ,precio original y demas , se puede usar para usuarios admin y solo tengan acceso a este modulo

3.- Se puede editar el sobre precio y costo envio , una vez que se agrega un sobre precio se agrega el precio original y se bloquea este para que quede como referencia y se pueda manipular el precio o devolverlo a su estado original , esto es porque el precio juega un inmportante roll en los calculos tanto de ordenes ,cotiazaciones , registros bancarios o de pago , metodos de enio y reglas de catalogo 

4.- Como son solo estos atributos se puede Truncar y Actualizarce esto con el fin de realizar operaciones rapidas de cambios de precios y la posiblidad de usar un CSV para su actualizacion, asi como ponerlo con un cron de trabajo para lanzar sobre precios en una fecha dada


Modulo Sample: este es un modulo que tiene sus propias tablas donde se agrea u titulo y un contenido , este contenido usa un HTML como editor y se genera una URI para poder usarlo
este modulo se puede usar para mostrar mapas o generar landing pages, el menu se encuentra en la columna izquierda principal , se pueden agregar y restringir de usuarios.


