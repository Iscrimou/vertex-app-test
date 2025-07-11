#!/bin/bash

# Ajusta permissões (executado já com volume montado)
chown -R www-data:www-data storage database/database.sqlite bootstrap/cache
chmod -R 775 storage database/database.sqlite bootstrap/cache

exec apache2-foreground