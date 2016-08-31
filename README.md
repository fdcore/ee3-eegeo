Plugin EE-Geo return geo tags on current ip or ip in params.

Plugin for ExpressionEngine 3

## Install

1. Copy folder **ee_geo** to **system/user/addons/**
2. Install in EE CP

## Tags Pair:

```
{exp:ee_geo:city}{/exp:ee_geo:city}
```

### Params:

type - binary read type: FILE, BATCH&MEMORY, BATCH, MEMORY  where FILE is default
ip - ip address for geo search, default used current ip address user.

### Tags:

ip - IP Address
country_iso - Country in ISO format (2 char)
city_lat - latitude
city_lon - lontinude
city_name_ru / city_name_en - city
region_name_ru / region_name_en - Region

## Example

```
{exp:ee_geo:city}
IP: {ip} <br>
country: {country_iso} <br>
lat: {city_lat} <br>
lon: {city_lon} <br>
city: {city_name_ru} <br>
region_name: {region_name_ru}<br>
{/exp:ee_geo:city}
```

## Simgle Tag

```
{exp:ee_geo:country}
```

Return country in ISO format.

Params:

type - binary read type: FILE, BATCH&MEMORY, BATCH, MEMORY  where FILE is default
ip - ip address for geo search, default used current ip address user.
