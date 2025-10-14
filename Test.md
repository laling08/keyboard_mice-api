
# Testing Guide for REST API Assignment
This guide will show the documentation of testing the resources of this homework.

## Base URL
All requests use: `http://localhost/hw1`

---
## 1. Vendors Collection
### GET /vendors
**Description:** Get all vendors

```
GET http://localhost/hw1/vendors
```
Response:
```json
{
  "meta": {
    "total": 31,
    "offset": 0,
    "current_page": 1,
    "page_size": 5,
    "total_pages": 7
  },
  "data": [
    {
      "vendor_id": 1,
      "name": "Cherry Corporation",
      "country": "Germany",
      "founded_year": 1953,
      "website": "https://www.cherry.de",
      "headquarters": "Auerbach, Germany",
      "keyboard_count": 6,
      "avg_keyboard_price": "153.323333"
    },
    {
      "vendor_id": 2,
      "name": "Gateron",
      "country": "China",
      "founded_year": 2000,
      "website": "https://www.gateron.com",
      "headquarters": "Huizhou, China",
      "keyboard_count": 6,
      "avg_keyboard_price": "174.990000"
    },
    {
      "vendor_id": 3,
      "name": "Kailh",
      "country": "China",
      "founded_year": 1990,
      "website": "https://www.kailh.com",
      "headquarters": "Dongguan, China",
      "keyboard_count": 7,
      "avg_keyboard_price": "104.275714"
    },
    {
      "vendor_id": 4,
      "name": "Outemu",
      "country": "China",
      "founded_year": 2009,
      "website": "https://www.outemu.com",
      "headquarters": "Guangdong, China",
      "keyboard_count": 8,
      "avg_keyboard_price": "48.115000"
    },
    {
      "vendor_id": 5,
      "name": "Razer",
      "country": "Singapore",
      "founded_year": 2005,
      "website": "https://www.razer.com",
      "headquarters": "Irvine, USA",
      "keyboard_count": 6,
      "avg_keyboard_price": "159.990000"
    }
  ]
}
```
**With Filters:**

```
GET http://localhost/hw1/vendors?country=Germany
```
Response:
```json
{
  "meta": {
    "total": 2,
    "offset": 0,
    "current_page": 1,
    "page_size": 5,
    "total_pages": 1
  },
  "data": [
    {
      "vendor_id": 1,
      "name": "Cherry Corporation",
      "country": "Germany",
      "founded_year": 1953,
      "website": "https://www.cherry.de",
      "headquarters": "Auerbach, Germany",
      "keyboard_count": 6,
      "avg_keyboard_price": "153.323333"
    },
    {
      "vendor_id": 28,
      "name": "Roccat",
      "country": "Germany",
      "founded_year": 2007,
      "website": "https://en.roccat.org",
      "headquarters": "Hamburg, Germany",
      "keyboard_count": 2,
      "avg_keyboard_price": "149.990000"
    }
  ]
}
```

```
GET http://localhost/hw1/vendors?founded_after=2000
```
Response:
```json
{
  "meta": {
    "total": 21,
    "offset": 0,
    "current_page": 1,
    "page_size": 5,
    "total_pages": 5
  },
  "data": [
    {
      "vendor_id": 2,
      "name": "Gateron",
      "country": "China",
      "founded_year": 2000,
      "website": "https://www.gateron.com",
      "headquarters": "Huizhou, China",
      "keyboard_count": 6,
      "avg_keyboard_price": "174.990000"
    },
    {
      "vendor_id": 4,
      "name": "Outemu",
      "country": "China",
      "founded_year": 2009,
      "website": "https://www.outemu.com",
      "headquarters": "Guangdong, China",
      "keyboard_count": 8,
      "avg_keyboard_price": "48.115000"
    },
    {
      "vendor_id": 5,
      "name": "Razer",
      "country": "Singapore",
      "founded_year": 2005,
      "website": "https://www.razer.com",
      "headquarters": "Irvine, USA",
      "keyboard_count": 6,
      "avg_keyboard_price": "159.990000"
    },
    {
      "vendor_id": 7,
      "name": "Zealios",
      "country": "Canada",
      "founded_year": 2014,
      "website": "https://zealpc.net",
      "headquarters": "Toronto, Canada",
      "keyboard_count": 7,
      "avg_keyboard_price": "348.142857"
    },
    {
      "vendor_id": 8,
      "name": "NovelKeys",
      "country": "USA",
      "founded_year": 2017,
      "website": "https://novelkeys.xyz",
      "headquarters": "Morgantown, USA",
      "keyboard_count": 5,
      "avg_keyboard_price": "260.000000"
    }
  ]
}
```

```
GET http://localhost/hw1/vendors?founded_before=2010
```
Response:
```json
{
  "meta": {
    "total": 18,
    "offset": 0,
    "current_page": 1,
    "page_size": 5,
    "total_pages": 4
  },
  "data": [
    {
      "vendor_id": 1,
      "name": "Cherry Corporation",
      "country": "Germany",
      "founded_year": 1953,
      "website": "https://www.cherry.de",
      "headquarters": "Auerbach, Germany",
      "keyboard_count": 6,
      "avg_keyboard_price": "153.323333"
    },
    {
      "vendor_id": 2,
      "name": "Gateron",
      "country": "China",
      "founded_year": 2000,
      "website": "https://www.gateron.com",
      "headquarters": "Huizhou, China",
      "keyboard_count": 6,
      "avg_keyboard_price": "174.990000"
    },
    {
      "vendor_id": 3,
      "name": "Kailh",
      "country": "China",
      "founded_year": 1990,
      "website": "https://www.kailh.com",
      "headquarters": "Dongguan, China",
      "keyboard_count": 7,
      "avg_keyboard_price": "104.275714"
    },
    {
      "vendor_id": 4,
      "name": "Outemu",
      "country": "China",
      "founded_year": 2009,
      "website": "https://www.outemu.com",
      "headquarters": "Guangdong, China",
      "keyboard_count": 8,
      "avg_keyboard_price": "48.115000"
    },
    {
      "vendor_id": 5,
      "name": "Razer",
      "country": "Singapore",
      "founded_year": 2005,
      "website": "https://www.razer.com",
      "headquarters": "Irvine, USA",
      "keyboard_count": 6,
      "avg_keyboard_price": "159.990000"
    }
  ]
}
```

```
GET http://localhost/hw1/vendors?keyboard_count_min=6
```
Response:
```json
{
  "meta": {
    "total": 8,
    "offset": 0,
    "current_page": 1,
    "page_size": 5,
    "total_pages": 2
  },
  "data": [
    {
      "vendor_id": 1,
      "name": "Cherry Corporation",
      "country": "Germany",
      "founded_year": 1953,
      "website": "https://www.cherry.de",
      "headquarters": "Auerbach, Germany",
      "keyboard_count": 6,
      "avg_keyboard_price": "153.323333"
    },
    {
      "vendor_id": 2,
      "name": "Gateron",
      "country": "China",
      "founded_year": 2000,
      "website": "https://www.gateron.com",
      "headquarters": "Huizhou, China",
      "keyboard_count": 6,
      "avg_keyboard_price": "174.990000"
    },
    {
      "vendor_id": 3,
      "name": "Kailh",
      "country": "China",
      "founded_year": 1990,
      "website": "https://www.kailh.com",
      "headquarters": "Dongguan, China",
      "keyboard_count": 7,
      "avg_keyboard_price": "104.275714"
    },
    {
      "vendor_id": 4,
      "name": "Outemu",
      "country": "China",
      "founded_year": 2009,
      "website": "https://www.outemu.com",
      "headquarters": "Guangdong, China",
      "keyboard_count": 8,
      "avg_keyboard_price": "48.115000"
    },
    {
      "vendor_id": 5,
      "name": "Razer",
      "country": "Singapore",
      "founded_year": 2005,
      "website": "https://www.razer.com",
      "headquarters": "Irvine, USA",
      "keyboard_count": 6,
      "avg_keyboard_price": "159.990000"
    }
  ]
}
```

```
GET http://localhost/hw1/vendors?avg_price_min=100&avg_price_max=150
```
Response:
```json
{
  "meta": {
    "total": 6,
    "offset": 0,
    "current_page": 1,
    "page_size": 5,
    "total_pages": 2
  },
  "data": [
    {
      "vendor_id": 3,
      "name": "Kailh",
      "country": "China",
      "founded_year": 1990,
      "website": "https://www.kailh.com",
      "headquarters": "Dongguan, China",
      "keyboard_count": 7,
      "avg_keyboard_price": "104.275714"
    },
    {
      "vendor_id": 11,
      "name": "Glorious",
      "country": "USA",
      "founded_year": 2014,
      "website": "https://www.gloriousgaming.com",
      "headquarters": "Dallas, USA",
      "keyboard_count": 6,
      "avg_keyboard_price": "126.656667"
    },
    {
      "vendor_id": 23,
      "name": "HyperX",
      "country": "USA",
      "founded_year": 2002,
      "website": "https://www.hyperxgaming.com",
      "headquarters": "Fountain Valley, USA",
      "keyboard_count": 3,
      "avg_keyboard_price": "109.990000"
    },
    {
      "vendor_id": 24,
      "name": "Ducky",
      "country": "Taiwan",
      "founded_year": 2008,
      "website": "https://www.duckychannel.com.tw",
      "headquarters": "Taipei, Taiwan",
      "keyboard_count": 3,
      "avg_keyboard_price": "119.990000"
    },
    {
      "vendor_id": 28,
      "name": "Roccat",
      "country": "Germany",
      "founded_year": 2007,
      "website": "https://en.roccat.org",
      "headquarters": "Hamburg, Germany",
      "keyboard_count": 2,
      "avg_keyboard_price": "149.990000"
    }
  ]
}
```

**With Pagination**
```
GET http://localhost/hw1/vendors?page=1&page_size=10
```
Response:
```json
{
  "meta": {
    "total": 31,
    "offset": 0,
    "current_page": 1,
    "page_size": 5,
    "total_pages": 7
  },
  "data": [
    {
      "vendor_id": 1,
      "name": "Cherry Corporation",
      "country": "Germany",
      "founded_year": 1953,
      "website": "https://www.cherry.de",
      "headquarters": "Auerbach, Germany",
      "keyboard_count": 6,
      "avg_keyboard_price": "153.323333"
    },
    {
      "vendor_id": 2,
      "name": "Gateron",
      "country": "China",
      "founded_year": 2000,
      "website": "https://www.gateron.com",
      "headquarters": "Huizhou, China",
      "keyboard_count": 6,
      "avg_keyboard_price": "174.990000"
    },
    {
      "vendor_id": 3,
      "name": "Kailh",
      "country": "China",
      "founded_year": 1990,
      "website": "https://www.kailh.com",
      "headquarters": "Dongguan, China",
      "keyboard_count": 7,
      "avg_keyboard_price": "104.275714"
    },
    {
      "vendor_id": 4,
      "name": "Outemu",
      "country": "China",
      "founded_year": 2009,
      "website": "https://www.outemu.com",
      "headquarters": "Guangdong, China",
      "keyboard_count": 8,
      "avg_keyboard_price": "48.115000"
    },
    {
      "vendor_id": 5,
      "name": "Razer",
      "country": "Singapore",
      "founded_year": 2005,
      "website": "https://www.razer.com",
      "headquarters": "Irvine, USA",
      "keyboard_count": 6,
      "avg_keyboard_price": "159.990000"
    }
  ]
}
```

**Combined**
```
GET http://localhost/hw1/vendors?country=Germany&founded_after=1990&page=1&page_size=5
```
Response:
```json
{
  "meta": {
    "total": 1,
    "offset": 0,
    "current_page": 1,
    "page_size": 5,
    "total_pages": 1
  },
  "data": [
    {
      "vendor_id": 28,
      "name": "Roccat",
      "country": "Germany",
      "founded_year": 2007,
      "website": "https://en.roccat.org",
      "headquarters": "Hamburg, Germany",
      "keyboard_count": 2,
      "avg_keyboard_price": "149.990000"
    }
  ]
}
```
---
## 2. Vendor Singleton
**Description:** Get a specific vendor

```
GET http://localhost/hw1/vendors/1
```
Response:
```json
{
  "vendor_id": 1,
  "name": "Cherry Corporation",
  "country": "Germany",
  "founded_year": 1953,
  "website": "https://www.cherry.de",
  "headquarters": "Auerbach, Germany"
}
```


```
GET http://localhost/hw1/vendors/5
```
Response:
```json
{
  "vendor_id": 5,
  "name": "Razer",
  "country": "Singapore",
  "founded_year": 2005,
  "website": "https://www.razer.com",
  "headquarters": "Irvine, USA"
}
```
---
## 3. Switches Sub-Collection
### GET/vendors/{vendor_id}/switches
**Description:** Get switches manufactured by a specific vendor

```
GET http://localhost/hw1/vendors/1/switches
```
Response:
```json
{
  "vendor": {
    "vendor_id": 1,
    "name": "Cherry Corporation",
    "country": "Germany",
    "founded_year": 1953,
    "website": "https://www.cherry.de",
    "headquarters": "Auerbach, Germany"
  },
  "meta": {
    "total": 0,
    "offset": 0,
    "current_page": 1,
    "page_size": 5,
    "total_pages": 0
  },
  "switches": []
}

```
**With Filters:**
```
GET http://localhost/hw1/vendors/1/switches?type=Linear
```
Response:
```json
{
  "vendor": {
    "vendor_id": 1,
    "name": "Cherry Corporation",
    "country": "Germany",
    "founded_year": 1953,
    "website": "https://www.cherry.de",
    "headquarters": "Auerbach, Germany"
  },
  "meta": {
    "total": 6,
    "offset": 0,
    "current_page": 1,
    "page_size": 5,
    "total_pages": 2
  },
  "switches": [
    {
      "switch_id": 1,
      "vendor_id": 1,
      "name": "MX Red",
      "type": "Linear",
      "actuation_force": 45,
      "bottom_out_force": 75,
      "pre_travel": "2.00",
      "total_travel": "4.00",
      "lifespan_million": 50,
      "release_date": "2008-01-15",
      "vendor_name": "Cherry Corporation"
    },
    {
      "switch_id": 2,
      "vendor_id": 1,
      "name": "MX Black",
      "type": "Linear",
      "actuation_force": 60,
      "bottom_out_force": 80,
      "pre_travel": "2.00",
      "total_travel": "4.00",
      "lifespan_million": 50,
      "release_date": "1984-03-20",
      "vendor_name": "Cherry Corporation"
    },
    {
      "switch_id": 7,
      "vendor_id": 1,
      "name": "MX Silent Red",
      "type": "Linear",
      "actuation_force": 45,
      "bottom_out_force": 75,
      "pre_travel": "1.90",
      "total_travel": "3.70",
      "lifespan_million": 50,
      "release_date": "2016-02-14",
      "vendor_name": "Cherry Corporation"
    },
    {
      "switch_id": 8,
      "vendor_id": 1,
      "name": "MX Silent Black",
      "type": "Linear",
      "actuation_force": 60,
      "bottom_out_force": 80,
      "pre_travel": "1.90",
      "total_travel": "3.70",
      "lifespan_million": 50,
      "release_date": "2016-02-14",
      "vendor_name": "Cherry Corporation"
    },
    {
      "switch_id": 9,
      "vendor_id": 1,
      "name": "MX Speed Silver",
      "type": "Linear",
      "actuation_force": 45,
      "bottom_out_force": 67,
      "pre_travel": "1.20",
      "total_travel": "3.40",
      "lifespan_million": 50,
      "release_date": "2016-04-10",
      "vendor_name": "Cherry Corporation"
    }
  ]
}
```

```
GET http://localhost/hw1/vendors/1/switches?type=Tactile
```
Response:
```json
{
  "vendor": {
    "vendor_id": 1,
    "name": "Cherry Corporation",
    "country": "Germany",
    "founded_year": 1953,
    "website": "https://www.cherry.de",
    "headquarters": "Auerbach, Germany"
  },
  "meta": {
    "total": 2,
    "offset": 0,
    "current_page": 1,
    "page_size": 5,
    "total_pages": 1
  },
  "switches": [
    {
      "switch_id": 3,
      "vendor_id": 1,
      "name": "MX Brown",
      "type": "Tactile",
      "actuation_force": 45,
      "bottom_out_force": 55,
      "pre_travel": "2.00",
      "total_travel": "4.00",
      "lifespan_million": 50,
      "release_date": "1994-08-10",
      "vendor_name": "Cherry Corporation"
    },
    {
      "switch_id": 5,
      "vendor_id": 1,
      "name": "MX Clear",
      "type": "Tactile",
      "actuation_force": 65,
      "bottom_out_force": 95,
      "pre_travel": "2.00",
      "total_travel": "4.00",
      "lifespan_million": 50,
      "release_date": "2012-06-18",
      "vendor_name": "Cherry Corporation"
    }
  ]
}
```

```
GET http://localhost/hw1/vendors/1/switches?actuation_force_min=45
```
Response:
```json
{
  "vendor": {
    "vendor_id": 1,
    "name": "Cherry Corporation",
    "country": "Germany",
    "founded_year": 1953,
    "website": "https://www.cherry.de",
    "headquarters": "Auerbach, Germany"
  },
  "meta": {
    "total": 10,
    "offset": 0,
    "current_page": 1,
    "page_size": 5,
    "total_pages": 2
  },
  "switches": [
    {
      "switch_id": 1,
      "vendor_id": 1,
      "name": "MX Red",
      "type": "Linear",
      "actuation_force": 45,
      "bottom_out_force": 75,
      "pre_travel": "2.00",
      "total_travel": "4.00",
      "lifespan_million": 50,
      "release_date": "2008-01-15",
      "vendor_name": "Cherry Corporation"
    },
    {
      "switch_id": 2,
      "vendor_id": 1,
      "name": "MX Black",
      "type": "Linear",
      "actuation_force": 60,
      "bottom_out_force": 80,
      "pre_travel": "2.00",
      "total_travel": "4.00",
      "lifespan_million": 50,
      "release_date": "1984-03-20",
      "vendor_name": "Cherry Corporation"
    },
    {
      "switch_id": 3,
      "vendor_id": 1,
      "name": "MX Brown",
      "type": "Tactile",
      "actuation_force": 45,
      "bottom_out_force": 55,
      "pre_travel": "2.00",
      "total_travel": "4.00",
      "lifespan_million": 50,
      "release_date": "1994-08-10",
      "vendor_name": "Cherry Corporation"
    },
    {
      "switch_id": 4,
      "vendor_id": 1,
      "name": "MX Blue",
      "type": "Clicky",
      "actuation_force": 50,
      "bottom_out_force": 60,
      "pre_travel": "2.20",
      "total_travel": "4.00",
      "lifespan_million": 50,
      "release_date": "1985-11-05",
      "vendor_name": "Cherry Corporation"
    },
    {
      "switch_id": 5,
      "vendor_id": 1,
      "name": "MX Clear",
      "type": "Tactile",
      "actuation_force": 65,
      "bottom_out_force": 95,
      "pre_travel": "2.00",
      "total_travel": "4.00",
      "lifespan_million": 50,
      "release_date": "2012-06-18",
      "vendor_name": "Cherry Corporation"
    }
  ]
}
```

```
GET http://localhost/hw1/vendors/1/switches?actuation_force_max=60
```
Response:
```json
{
  "vendor": {
    "vendor_id": 1,
    "name": "Cherry Corporation",
    "country": "Germany",
    "founded_year": 1953,
    "website": "https://www.cherry.de",
    "headquarters": "Auerbach, Germany"
  },
  "meta": {
    "total": 10,
    "offset": 0,
    "current_page": 1,
    "page_size": 5,
    "total_pages": 2
  },
  "switches": [
    {
      "switch_id": 1,
      "vendor_id": 1,
      "name": "MX Red",
      "type": "Linear",
      "actuation_force": 45,
      "bottom_out_force": 75,
      "pre_travel": "2.00",
      "total_travel": "4.00",
      "lifespan_million": 50,
      "release_date": "2008-01-15",
      "vendor_name": "Cherry Corporation"
    },
    {
      "switch_id": 2,
      "vendor_id": 1,
      "name": "MX Black",
      "type": "Linear",
      "actuation_force": 60,
      "bottom_out_force": 80,
      "pre_travel": "2.00",
      "total_travel": "4.00",
      "lifespan_million": 50,
      "release_date": "1984-03-20",
      "vendor_name": "Cherry Corporation"
    },
    {
      "switch_id": 3,
      "vendor_id": 1,
      "name": "MX Brown",
      "type": "Tactile",
      "actuation_force": 45,
      "bottom_out_force": 55,
      "pre_travel": "2.00",
      "total_travel": "4.00",
      "lifespan_million": 50,
      "release_date": "1994-08-10",
      "vendor_name": "Cherry Corporation"
    },
    {
      "switch_id": 4,
      "vendor_id": 1,
      "name": "MX Blue",
      "type": "Clicky",
      "actuation_force": 50,
      "bottom_out_force": 60,
      "pre_travel": "2.20",
      "total_travel": "4.00",
      "lifespan_million": 50,
      "release_date": "1985-11-05",
      "vendor_name": "Cherry Corporation"
    },
    {
      "switch_id": 5,
      "vendor_id": 1,
      "name": "MX Clear",
      "type": "Tactile",
      "actuation_force": 65,
      "bottom_out_force": 95,
      "pre_travel": "2.00",
      "total_travel": "4.00",
      "lifespan_million": 50,
      "release_date": "2012-06-18",
      "vendor_name": "Cherry Corporation"
    }
  ]
}
```

```
GET http://localhost/hw1/vendors/1/switches?actuation_force_min=45&actuation_force_max=60
```
Response:
```json
{
  "vendor": {
    "vendor_id": 1,
    "name": "Cherry Corporation",
    "country": "Germany",
    "founded_year": 1953,
    "website": "https://www.cherry.de",
    "headquarters": "Auerbach, Germany"
  },
  "meta": {
    "total": 8,
    "offset": 0,
    "current_page": 1,
    "page_size": 5,
    "total_pages": 2
  },
  "switches": [
    {
      "switch_id": 1,
      "vendor_id": 1,
      "name": "MX Red",
      "type": "Linear",
      "actuation_force": 45,
      "bottom_out_force": 75,
      "pre_travel": "2.00",
      "total_travel": "4.00",
      "lifespan_million": 50,
      "release_date": "2008-01-15",
      "vendor_name": "Cherry Corporation"
    },
    {
      "switch_id": 2,
      "vendor_id": 1,
      "name": "MX Black",
      "type": "Linear",
      "actuation_force": 60,
      "bottom_out_force": 80,
      "pre_travel": "2.00",
      "total_travel": "4.00",
      "lifespan_million": 50,
      "release_date": "1984-03-20",
      "vendor_name": "Cherry Corporation"
    },
    {
      "switch_id": 3,
      "vendor_id": 1,
      "name": "MX Brown",
      "type": "Tactile",
      "actuation_force": 45,
      "bottom_out_force": 55,
      "pre_travel": "2.00",
      "total_travel": "4.00",
      "lifespan_million": 50,
      "release_date": "1994-08-10",
      "vendor_name": "Cherry Corporation"
    },
    {
      "switch_id": 4,
      "vendor_id": 1,
      "name": "MX Blue",
      "type": "Clicky",
      "actuation_force": 50,
      "bottom_out_force": 60,
      "pre_travel": "2.20",
      "total_travel": "4.00",
      "lifespan_million": 50,
      "release_date": "1985-11-05",
      "vendor_name": "Cherry Corporation"
    },
    {
      "switch_id": 7,
      "vendor_id": 1,
      "name": "MX Silent Red",
      "type": "Linear",
      "actuation_force": 45,
      "bottom_out_force": 75,
      "pre_travel": "1.90",
      "total_travel": "3.70",
      "lifespan_million": 50,
      "release_date": "2016-02-14",
      "vendor_name": "Cherry Corporation"
    }
  ]
}
```

```
GET http://localhost/hw1/vendors/1/switches?travel_distance_min=3.5
```
Response:
```json
{
  "vendor": {
    "vendor_id": 1,
    "name": "Cherry Corporation",
    "country": "Germany",
    "founded_year": 1953,
    "website": "https://www.cherry.de",
    "headquarters": "Auerbach, Germany"
  },
  "meta": {
    "total": 8,
    "offset": 0,
    "current_page": 1,
    "page_size": 5,
    "total_pages": 2
  },
  "switches": [
    {
      "switch_id": 1,
      "vendor_id": 1,
      "name": "MX Red",
      "type": "Linear",
      "actuation_force": 45,
      "bottom_out_force": 75,
      "pre_travel": "2.00",
      "total_travel": "4.00",
      "lifespan_million": 50,
      "release_date": "2008-01-15",
      "vendor_name": "Cherry Corporation"
    },
    {
      "switch_id": 2,
      "vendor_id": 1,
      "name": "MX Black",
      "type": "Linear",
      "actuation_force": 60,
      "bottom_out_force": 80,
      "pre_travel": "2.00",
      "total_travel": "4.00",
      "lifespan_million": 50,
      "release_date": "1984-03-20",
      "vendor_name": "Cherry Corporation"
    },
    {
      "switch_id": 3,
      "vendor_id": 1,
      "name": "MX Brown",
      "type": "Tactile",
      "actuation_force": 45,
      "bottom_out_force": 55,
      "pre_travel": "2.00",
      "total_travel": "4.00",
      "lifespan_million": 50,
      "release_date": "1994-08-10",
      "vendor_name": "Cherry Corporation"
    },
    {
      "switch_id": 4,
      "vendor_id": 1,
      "name": "MX Blue",
      "type": "Clicky",
      "actuation_force": 50,
      "bottom_out_force": 60,
      "pre_travel": "2.20",
      "total_travel": "4.00",
      "lifespan_million": 50,
      "release_date": "1985-11-05",
      "vendor_name": "Cherry Corporation"
    },
    {
      "switch_id": 5,
      "vendor_id": 1,
      "name": "MX Clear",
      "type": "Tactile",
      "actuation_force": 65,
      "bottom_out_force": 95,
      "pre_travel": "2.00",
      "total_travel": "4.00",
      "lifespan_million": 50,
      "release_date": "2012-06-18",
      "vendor_name": "Cherry Corporation"
    }
  ]
}
```

```
GET http://localhost/hw1/vendors/1/switches?lifespan_min=50
```
Response:
```json
{
  "vendor": {
    "vendor_id": 1,
    "name": "Cherry Corporation",
    "country": "Germany",
    "founded_year": 1953,
    "website": "https://www.cherry.de",
    "headquarters": "Auerbach, Germany"
  },
  "meta": {
    "total": 10,
    "offset": 0,
    "current_page": 1,
    "page_size": 5,
    "total_pages": 2
  },
  "switches": [
    {
      "switch_id": 1,
      "vendor_id": 1,
      "name": "MX Red",
      "type": "Linear",
      "actuation_force": 45,
      "bottom_out_force": 75,
      "pre_travel": "2.00",
      "total_travel": "4.00",
      "lifespan_million": 50,
      "release_date": "2008-01-15",
      "vendor_name": "Cherry Corporation"
    },
    {
      "switch_id": 2,
      "vendor_id": 1,
      "name": "MX Black",
      "type": "Linear",
      "actuation_force": 60,
      "bottom_out_force": 80,
      "pre_travel": "2.00",
      "total_travel": "4.00",
      "lifespan_million": 50,
      "release_date": "1984-03-20",
      "vendor_name": "Cherry Corporation"
    },
    {
      "switch_id": 3,
      "vendor_id": 1,
      "name": "MX Brown",
      "type": "Tactile",
      "actuation_force": 45,
      "bottom_out_force": 55,
      "pre_travel": "2.00",
      "total_travel": "4.00",
      "lifespan_million": 50,
      "release_date": "1994-08-10",
      "vendor_name": "Cherry Corporation"
    },
    {
      "switch_id": 4,
      "vendor_id": 1,
      "name": "MX Blue",
      "type": "Clicky",
      "actuation_force": 50,
      "bottom_out_force": 60,
      "pre_travel": "2.20",
      "total_travel": "4.00",
      "lifespan_million": 50,
      "release_date": "1985-11-05",
      "vendor_name": "Cherry Corporation"
    },
    {
      "switch_id": 5,
      "vendor_id": 1,
      "name": "MX Clear",
      "type": "Tactile",
      "actuation_force": 65,
      "bottom_out_force": 95,
      "pre_travel": "2.00",
      "total_travel": "4.00",
      "lifespan_million": 50,
      "release_date": "2012-06-18",
      "vendor_name": "Cherry Corporation"
    }
  ]
}
```

```
GET http://localhost/hw1/vendors/1/switches?release_date_after=2020-01-01
```
Response:
```json
{
  "vendor": {
    "vendor_id": 1,
    "name": "Cherry Corporation",
    "country": "Germany",
    "founded_year": 1953,
    "website": "https://www.cherry.de",
    "headquarters": "Auerbach, Germany"
  },
  "meta": {
    "total": 0,
    "offset": 0,
    "current_page": 1,
    "page_size": 5,
    "total_pages": 0
  },
  "switches": []
}
```
---
## 4. Keyboards Collection
### GET /keyboards

**Description:** Get all keyboards

**Basic Request:**
```
GET http://localhost/hw1/keyboards
```
Response:
```json
{
  "meta": {
    "total": 9,
    "offset": 0,
    "current_page": 1,
    "page_size": 5,
    "total_pages": 2
  },
  "data": [
    {
      "keyboard_id": 1,
      "vendor_id": 1,
      "switch_id": 1,
      "layout_id": 1,
      "name": "MX Board 3.0S",
      "release_date": "2018-03-15",
      "price": "129.99",
      "connectivity": "Wired",
      "hot_swappable": 0,
      "case_material": "Plastic",
      "weight": "1200.00",
      "vendor_name": "Cherry Corporation",
      "switch_name": "MX Red",
      "layout_name": "Full Size"
    },
    {
      "keyboard_id": 77,
      "vendor_id": 1,
      "switch_id": 1,
      "layout_id": 2,
      "name": "MX Board 3.0S RGB",
      "release_date": "2019-11-12",
      "price": "159.99",
      "connectivity": "Wired",
      "hot_swappable": 0,
      "case_material": "Aluminum",
      "weight": "1280.00",
      "vendor_name": "Cherry Corporation",
      "switch_name": "MX Red",
      "layout_name": "Full Size"
    },
    {
      "keyboard_id": 2,
      "vendor_id": 1,
      "switch_id": 2,
      "layout_id": 2,
      "name": "MX Board 8.0",
      "release_date": "2017-09-20",
      "price": "179.99",
      "connectivity": "Wired",
      "hot_swappable": 0,
      "case_material": "Aluminum",
      "weight": "1450.00",
      "vendor_name": "Cherry Corporation",
      "switch_name": "MX Black",
      "layout_name": "TKL"
    },
    {
      "keyboard_id": 3,
      "vendor_id": 1,
      "switch_id": 3,
      "layout_id": 1,
      "name": "MX Board 1.0 TKL",
      "release_date": "2019-06-12",
      "price": "99.99",
      "connectivity": "Wired",
      "hot_swappable": 0,
      "case_material": "Plastic",
      "weight": "950.00",
      "vendor_name": "Cherry Corporation",
      "switch_name": "MX Brown",
      "layout_name": "75%"
    },
    {
      "keyboard_id": 4,
      "vendor_id": 1,
      "switch_id": 4,
      "layout_id": 3,
      "name": "MX Board 2.0S",
      "release_date": "2020-01-08",
      "price": "149.99",
      "connectivity": "Wired",
      "hot_swappable": 0,
      "case_material": "Aluminum",
      "weight": "1100.00",
      "vendor_name": "Cherry Corporation",
      "switch_name": "MX Blue",
      "layout_name": "65%"
    }
  ]
}
```

**With Filters:**

```
GET http://localhost/hw1/keyboards?switch_type=Linear
```
Response:
```json
{
  "meta": {
    "total": 7,
    "offset": 0,
    "current_page": 1,
    "page_size": 5,
    "total_pages": 2
  },
  "data": [
    {
      "keyboard_id": 1,
      "vendor_id": 1,
      "switch_id": 1,
      "layout_id": 1,
      "name": "MX Board 3.0S",
      "release_date": "2018-03-15",
      "price": "129.99",
      "connectivity": "Wired",
      "hot_swappable": 0,
      "case_material": "Plastic",
      "weight": "1200.00",
      "vendor_name": "Cherry Corporation",
      "switch_name": "MX Red",
      "layout_name": "Full Size"
    },
    {
      "keyboard_id": 77,
      "vendor_id": 1,
      "switch_id": 1,
      "layout_id": 2,
      "name": "MX Board 3.0S RGB",
      "release_date": "2019-11-12",
      "price": "159.99",
      "connectivity": "Wired",
      "hot_swappable": 0,
      "case_material": "Aluminum",
      "weight": "1280.00",
      "vendor_name": "Cherry Corporation",
      "switch_name": "MX Red",
      "layout_name": "Full Size"
    },
    {
      "keyboard_id": 2,
      "vendor_id": 1,
      "switch_id": 2,
      "layout_id": 2,
      "name": "MX Board 8.0",
      "release_date": "2017-09-20",
      "price": "179.99",
      "connectivity": "Wired",
      "hot_swappable": 0,
      "case_material": "Aluminum",
      "weight": "1450.00",
      "vendor_name": "Cherry Corporation",
      "switch_name": "MX Black",
      "layout_name": "TKL"
    },
    {
      "keyboard_id": 5,
      "vendor_id": 1,
      "switch_id": 7,
      "layout_id": 5,
      "name": "MX Keys Mini",
      "release_date": "2021-08-25",
      "price": "199.99",
      "connectivity": "Wireless",
      "hot_swappable": 0,
      "case_material": "Aluminum",
      "weight": "750.00",
      "vendor_name": "Cherry Corporation",
      "switch_name": "MX Silent Red",
      "layout_name": "Full Size ISO"
    },
    {
      "keyboard_id": 6,
      "vendor_id": 2,
      "switch_id": 11,
      "layout_id": 5,
      "name": "Keychron K6",
      "release_date": "2020-04-15",
      "price": "79.99",
      "connectivity": "Both",
      "hot_swappable": 1,
      "case_material": "Aluminum",
      "weight": "820.00",
      "vendor_name": "Gateron",
      "switch_name": "Red",
      "layout_name": "96%"
    }
  ]
}
```

```
GET http://localhost/hw1/keyboards?connectivity=Wireless
```
Response:
```json
{
  "meta": {
    "total": 1,
    "offset": 0,
    "current_page": 1,
    "page_size": 5,
    "total_pages": 1
  },
  "data": [
    {
      "keyboard_id": 5,
      "vendor_id": 1,
      "switch_id": 7,
      "layout_id": 5,
      "name": "MX Keys Mini",
      "release_date": "2021-08-25",
      "price": "199.99",
      "connectivity": "Wireless",
      "hot_swappable": 0,
      "case_material": "Aluminum",
      "weight": "750.00",
      "vendor_name": "Cherry Corporation",
      "switch_name": "MX Silent Red",
      "layout_name": "Full Size ISO"
    }
  ]
}
```

```
GET http://localhost/hw1/keyboards?hot_swappable=true
```
Response:
```json
{
  "meta": {
    "total": 2,
    "offset": 0,
    "current_page": 1,
    "page_size": 5,
    "total_pages": 1
  },
  "data": [
    {
      "keyboard_id": 6,
      "vendor_id": 2,
      "switch_id": 11,
      "layout_id": 5,
      "name": "Keychron K6",
      "release_date": "2020-04-15",
      "price": "79.99",
      "connectivity": "Both",
      "hot_swappable": 1,
      "case_material": "Aluminum",
      "weight": "820.00",
      "vendor_name": "Gateron",
      "switch_name": "Red",
      "layout_name": "96%"
    },
    {
      "keyboard_id": 7,
      "vendor_id": 2,
      "switch_id": 12,
      "layout_id": 4,
      "name": "Keychron Q1",
      "release_date": "2021-07-20",
      "price": "179.99",
      "connectivity": "Wired",
      "hot_swappable": 1,
      "case_material": "Aluminum",
      "weight": "1580.00",
      "vendor_name": "Gateron",
      "switch_name": "Black",
      "layout_name": "Split Ergonomic"
    }
  ]
}
```

```
GET http://localhost/hw1/keyboards?weight_max=1280.00
```
Response:
```json
{
  "meta": {
    "total": 1,
    "offset": 0,
    "current_page": 1,
    "page_size": 5,
    "total_pages": 1
  },
  "data": [
    {
      "keyboard_id": 77,
      "vendor_id": 1,
      "switch_id": 1,
      "layout_id": 2,
      "name": "MX Board 3.0S RGB",
      "release_date": "2019-11-12",
      "price": "159.99",
      "connectivity": "Wired",
      "hot_swappable": 0,
      "case_material": "Aluminum",
      "weight": "1280.00",
      "vendor_name": "Cherry Corporation",
      "switch_name": "MX Red",
      "layout_name": "Full Size"
    }
  ]
}

```

```
GET http://localhost/hw1/keyboards?release_date_after=2020-01-01
```
Response:
```json
{
  "meta": {
    "total": 9,
    "offset": 0,
    "current_page": 1,
    "page_size": 5,
    "total_pages": 2
  },
  "data": [
    {
      "keyboard_id": 1,
      "vendor_id": 1,
      "switch_id": 1,
      "layout_id": 1,
      "name": "MX Board 3.0S",
      "release_date": "2018-03-15",
      "price": "129.99",
      "connectivity": "Wired",
      "hot_swappable": 0,
      "case_material": "Plastic",
      "weight": "1200.00",
      "vendor_name": "Cherry Corporation",
      "switch_name": "MX Red",
      "layout_name": "Full Size"
    },
    {
      "keyboard_id": 77,
      "vendor_id": 1,
      "switch_id": 1,
      "layout_id": 2,
      "name": "MX Board 3.0S RGB",
      "release_date": "2019-11-12",
      "price": "159.99",
      "connectivity": "Wired",
      "hot_swappable": 0,
      "case_material": "Aluminum",
      "weight": "1280.00",
      "vendor_name": "Cherry Corporation",
      "switch_name": "MX Red",
      "layout_name": "Full Size"
    },
    {
      "keyboard_id": 2,
      "vendor_id": 1,
      "switch_id": 2,
      "layout_id": 2,
      "name": "MX Board 8.0",
      "release_date": "2017-09-20",
      "price": "179.99",
      "connectivity": "Wired",
      "hot_swappable": 0,
      "case_material": "Aluminum",
      "weight": "1450.00",
      "vendor_name": "Cherry Corporation",
      "switch_name": "MX Black",
      "layout_name": "TKL"
    },
    {
      "keyboard_id": 3,
      "vendor_id": 1,
      "switch_id": 3,
      "layout_id": 1,
      "name": "MX Board 1.0 TKL",
      "release_date": "2019-06-12",
      "price": "99.99",
      "connectivity": "Wired",
      "hot_swappable": 0,
      "case_material": "Plastic",
      "weight": "950.00",
      "vendor_name": "Cherry Corporation",
      "switch_name": "MX Brown",
      "layout_name": "75%"
    },
    {
      "keyboard_id": 4,
      "vendor_id": 1,
      "switch_id": 4,
      "layout_id": 3,
      "name": "MX Board 2.0S",
      "release_date": "2020-01-08",
      "price": "149.99",
      "connectivity": "Wired",
      "hot_swappable": 0,
      "case_material": "Aluminum",
      "weight": "1100.00",
      "vendor_name": "Cherry Corporation",
      "switch_name": "MX Blue",
      "layout_name": "65%"
    }
  ]
}
```

```
GET http://localhost/hw1/keyboards?release_date_before=2023-12-31
```
Response:
```json
{
  "meta": {
    "total": 9,
    "offset": 0,
    "current_page": 1,
    "page_size": 5,
    "total_pages": 2
  },
  "data": [
    {
      "keyboard_id": 1,
      "vendor_id": 1,
      "switch_id": 1,
      "layout_id": 1,
      "name": "MX Board 3.0S",
      "release_date": "2018-03-15",
      "price": "129.99",
      "connectivity": "Wired",
      "hot_swappable": 0,
      "case_material": "Plastic",
      "weight": "1200.00",
      "vendor_name": "Cherry Corporation",
      "switch_name": "MX Red",
      "layout_name": "Full Size"
    },
    {
      "keyboard_id": 77,
      "vendor_id": 1,
      "switch_id": 1,
      "layout_id": 2,
      "name": "MX Board 3.0S RGB",
      "release_date": "2019-11-12",
      "price": "159.99",
      "connectivity": "Wired",
      "hot_swappable": 0,
      "case_material": "Aluminum",
      "weight": "1280.00",
      "vendor_name": "Cherry Corporation",
      "switch_name": "MX Red",
      "layout_name": "Full Size"
    },
    {
      "keyboard_id": 2,
      "vendor_id": 1,
      "switch_id": 2,
      "layout_id": 2,
      "name": "MX Board 8.0",
      "release_date": "2017-09-20",
      "price": "179.99",
      "connectivity": "Wired",
      "hot_swappable": 0,
      "case_material": "Aluminum",
      "weight": "1450.00",
      "vendor_name": "Cherry Corporation",
      "switch_name": "MX Black",
      "layout_name": "TKL"
    },
    {
      "keyboard_id": 3,
      "vendor_id": 1,
      "switch_id": 3,
      "layout_id": 1,
      "name": "MX Board 1.0 TKL",
      "release_date": "2019-06-12",
      "price": "99.99",
      "connectivity": "Wired",
      "hot_swappable": 0,
      "case_material": "Plastic",
      "weight": "950.00",
      "vendor_name": "Cherry Corporation",
      "switch_name": "MX Brown",
      "layout_name": "75%"
    },
    {
      "keyboard_id": 4,
      "vendor_id": 1,
      "switch_id": 4,
      "layout_id": 3,
      "name": "MX Board 2.0S",
      "release_date": "2020-01-08",
      "price": "149.99",
      "connectivity": "Wired",
      "hot_swappable": 0,
      "case_material": "Aluminum",
      "weight": "1100.00",
      "vendor_name": "Cherry Corporation",
      "switch_name": "MX Blue",
      "layout_name": "65%"
    }
  ]
}
```

```
GET http://localhost/hw1/keyboards?pcb_firmware=QMK
```
Response:
```json
{
  "meta": {
    "total": 9,
    "offset": 0,
    "current_page": 1,
    "page_size": 5,
    "total_pages": 2
  },
  "data": [
    {
      "keyboard_id": 1,
      "vendor_id": 1,
      "switch_id": 1,
      "layout_id": 1,
      "name": "MX Board 3.0S",
      "release_date": "2018-03-15",
      "price": "129.99",
      "connectivity": "Wired",
      "hot_swappable": 0,
      "case_material": "Plastic",
      "weight": "1200.00",
      "vendor_name": "Cherry Corporation",
      "switch_name": "MX Red",
      "layout_name": "Full Size"
    },
    {
      "keyboard_id": 77,
      "vendor_id": 1,
      "switch_id": 1,
      "layout_id": 2,
      "name": "MX Board 3.0S RGB",
      "release_date": "2019-11-12",
      "price": "159.99",
      "connectivity": "Wired",
      "hot_swappable": 0,
      "case_material": "Aluminum",
      "weight": "1280.00",
      "vendor_name": "Cherry Corporation",
      "switch_name": "MX Red",
      "layout_name": "Full Size"
    },
    {
      "keyboard_id": 2,
      "vendor_id": 1,
      "switch_id": 2,
      "layout_id": 2,
      "name": "MX Board 8.0",
      "release_date": "2017-09-20",
      "price": "179.99",
      "connectivity": "Wired",
      "hot_swappable": 0,
      "case_material": "Aluminum",
      "weight": "1450.00",
      "vendor_name": "Cherry Corporation",
      "switch_name": "MX Black",
      "layout_name": "TKL"
    },
    {
      "keyboard_id": 3,
      "vendor_id": 1,
      "switch_id": 3,
      "layout_id": 1,
      "name": "MX Board 1.0 TKL",
      "release_date": "2019-06-12",
      "price": "99.99",
      "connectivity": "Wired",
      "hot_swappable": 0,
      "case_material": "Plastic",
      "weight": "950.00",
      "vendor_name": "Cherry Corporation",
      "switch_name": "MX Brown",
      "layout_name": "75%"
    },
    {
      "keyboard_id": 4,
      "vendor_id": 1,
      "switch_id": 4,
      "layout_id": 3,
      "name": "MX Board 2.0S",
      "release_date": "2020-01-08",
      "price": "149.99",
      "connectivity": "Wired",
      "hot_swappable": 0,
      "case_material": "Aluminum",
      "weight": "1100.00",
      "vendor_name": "Cherry Corporation",
      "switch_name": "MX Blue",
      "layout_name": "65%"
    }
  ]
}
```

**Combined Filters:**
```
GET http://localhost/hw1/keyboards?switch_type=Linear&hot_swappable=true&connectivity=Wired
```
Response:
```json
{
  "meta": {
    "total": 15,
    "offset": 0,
    "current_page": 1,
    "page_size": 5,
    "total_pages": 3
  },
  "data": [
    {
      "keyboard_id": 7,
      "vendor_id": 2,
      "switch_id": 12,
      "layout_id": 4,
      "name": "Keychron Q1",
      "release_date": "2021-07-20",
      "price": "179.99",
      "connectivity": "Wired",
      "hot_swappable": 1,
      "case_material": "Aluminum",
      "weight": "1580.00",
      "vendor_name": "Gateron",
      "switch_name": "Black",
      "switch_type": "Linear",
      "layout_name": "65%",
      "pcb_firmware": null
    },
    {
      "keyboard_id": 8,
      "vendor_id": 2,
      "switch_id": 13,
      "layout_id": 3,
      "name": "Keychron Q2",
      "release_date": "2021-11-15",
      "price": "189.99",
      "connectivity": "Wired",
      "hot_swappable": 1,
      "case_material": "Aluminum",
      "weight": "1420.00",
      "vendor_name": "Gateron",
      "switch_name": "Yellow",
      "switch_type": "Linear",
      "layout_name": "75%",
      "pcb_firmware": null
    },
    {
      "keyboard_id": 29,
      "vendor_id": 6,
      "switch_id": 47,
      "layout_id": 2,
      "name": "G Pro X",
      "release_date": "2019-08-15",
      "price": "149.99",
      "connectivity": "Wired",
      "hot_swappable": 1,
      "case_material": "Aluminum",
      "weight": "980.00",
      "vendor_name": "Logitech",
      "switch_name": "Phoenix",
      "switch_type": "Linear",
      "layout_name": "TKL",
      "pcb_firmware": "Proprietary"
    },
    {
      "keyboard_id": 33,
      "vendor_id": 7,
      "switch_id": 51,
      "layout_id": 3,
      "name": "Think6.5 V2",
      "release_date": "2021-04-12",
      "price": "385.00",
      "connectivity": "Wired",
      "hot_swappable": 1,
      "case_material": "Aluminum",
      "weight": "1650.00",
      "vendor_name": "Zealios",
      "switch_name": "Yellow",
      "switch_type": "Linear",
      "layout_name": "75%",
      "pcb_firmware": null
    },
    {
      "keyboard_id": 35,
      "vendor_id": 7,
      "switch_id": 53,
      "layout_id": 2,
      "name": "Polaris75",
      "release_date": "2022-01-18",
      "price": "350.00",
      "connectivity": "Wired",
      "hot_swappable": 1,
      "case_material": "Aluminum",
      "weight": "1520.00",
      "vendor_name": "Zealios",
      "switch_name": "Red",
      "switch_type": "Linear",
      "layout_name": "TKL",
      "pcb_firmware": "QMK"
    }
  ]
}
```

## 5. Keyboard Singleton
### GET /keyboards/{keyboard_id}

**Description:** Get a specific keyboard

**Request:**
```
GET http://localhost/hw1/keyboards/1
```
Response: 
```json
{
  "keyboard_id": 1,
  "vendor_id": 1,
  "switch_id": 1,
  "layout_id": 1,
  "name": "MX Board 3.0S",
  "release_date": "2018-03-15",
  "price": "129.99",
  "connectivity": "Wired",
  "hot_swappable": 0,
  "case_material": "Plastic",
  "weight": "1200.00",
  "vendor_name": "Cherry Corporation",
  "switch_name": "MX Red",
  "layout_name": "Full Size"
}
```

```
GET http://localhost/hw1/keyboards/10
```
```json
{
  "keyboard_id": 10,
  "vendor_id": 2,
  "switch_id": 15,
  "layout_id": 1,
  "name": "Keychron Q5",
  "release_date": "2022-06-05",
  "price": "219.99",
  "connectivity": "Wired",
  "hot_swappable": 1,
  "case_material": "Aluminum",
  "weight": "1950.00",
  "vendor_name": "Gateron",
  "switch_name": "Blue",
  "layout_name": "Full Size"
}
```

## 6. Layout Keyboards Sub-Collection
### GET /layouts/{layout_id}/keyboards
**Description:** Get keyboards that use a specific layout

**Basic Request:**
```
GET http://localhost/hw1/layouts/1/keyboards
```
Response:
```json
{
  "layout": {
    "layout_id": 1,
    "name": "Full Size",
    "description": "Standard full-size layout with numpad",
    "key_count": 104,
    "is_iso": 0
  },
  "meta": {
    "total": 0,
    "offset": 0,
    "current_page": 1,
    "page_size": 5,
    "total_pages": 0
  },
  "keyboards": []
}
```

**With Filters:**
```
GET http://localhost/hw1/layouts/1/keyboards?switch_type=Linear
```
Response:
```json
{
  "layout": {
    "layout_id": 1,
    "name": "Full Size",
    "description": "Standard full-size layout with numpad",
    "key_count": 104,
    "is_iso": 0
  },
  "meta": {
    "total": 8,
    "offset": 0,
    "current_page": 1,
    "page_size": 5,
    "total_pages": 2
  },
  "keyboards": [
    {
      "keyboard_id": 1,
      "vendor_id": 1,
      "switch_id": 1,
      "layout_id": 1,
      "name": "MX Board 3.0S",
      "release_date": "2018-03-15",
      "price": "129.99",
      "connectivity": "Wired",
      "hot_swappable": 0,
      "case_material": "Plastic",
      "weight": "1200.00",
      "vendor_name": "Cherry Corporation",
      "switch_name": "MX Red",
      "switch_type": "Linear"
    },
    {
      "keyboard_id": 14,
      "vendor_id": 3,
      "switch_id": 22,
      "layout_id": 1,
      "name": "Ducky One 2",
      "release_date": "2018-08-30",
      "price": "129.99",
      "connectivity": "Wired",
      "hot_swappable": 0,
      "case_material": "Plastic",
      "weight": "1180.00",
      "vendor_name": "Kailh",
      "switch_name": "Ink Black",
      "switch_type": "Linear"
    },
    {
      "keyboard_id": 22,
      "vendor_id": 5,
      "switch_id": 40,
      "layout_id": 1,
      "name": "BlackWidow V3",
      "release_date": "2020-08-11",
      "price": "169.99",
      "connectivity": "Wired",
      "hot_swappable": 0,
      "case_material": "Aluminum",
      "weight": "1400.00",
      "vendor_name": "Razer",
      "switch_name": "Cream",
      "switch_type": "Linear"
    },
    {
      "keyboard_id": 46,
      "vendor_id": 11,
      "switch_id": 64,
      "layout_id": 1,
      "name": "GMMK Pro",
      "release_date": "2021-03-31",
      "price": "169.99",
      "connectivity": "Wired",
      "hot_swappable": 1,
      "case_material": "Aluminum",
      "weight": "1360.00",
      "vendor_name": "Glorious",
      "switch_name": "Tealios V2",
      "switch_type": "Linear"
    },
    {
      "keyboard_id": 80,
      "vendor_id": 21,
      "switch_id": 84,
      "layout_id": 1,
      "name": "K100 RGB",
      "release_date": "2020-09-21",
      "price": "229.99",
      "connectivity": "Wired",
      "hot_swappable": 0,
      "case_material": "Aluminum",
      "weight": "1200.00",
      "vendor_name": "Corsair",
      "switch_name": "Starfish",
      "switch_type": "Linear"
    }
  ]
}

```

```
GET http://localhost/hw1/layouts/1/keyboards?price_min=100&price_max=300
```
Response:
```json
{
  "layout": {
    "layout_id": 1,
    "name": "Full Size",
    "description": "Standard full-size layout with numpad",
    "key_count": 104,
    "is_iso": 0
  },
  "meta": {
    "total": 13,
    "offset": 0,
    "current_page": 1,
    "page_size": 5,
    "total_pages": 3
  },
  "keyboards": [
    {
      "keyboard_id": 1,
      "vendor_id": 1,
      "switch_id": 1,
      "layout_id": 1,
      "name": "MX Board 3.0S",
      "release_date": "2018-03-15",
      "price": "129.99",
      "connectivity": "Wired",
      "hot_swappable": 0,
      "case_material": "Plastic",
      "weight": "1200.00",
      "vendor_name": "Cherry Corporation",
      "switch_name": "MX Red",
      "switch_type": "Linear"
    },
    {
      "keyboard_id": 10,
      "vendor_id": 2,
      "switch_id": 15,
      "layout_id": 1,
      "name": "Keychron Q5",
      "release_date": "2022-06-05",
      "price": "219.99",
      "connectivity": "Wired",
      "hot_swappable": 1,
      "case_material": "Aluminum",
      "weight": "1950.00",
      "vendor_name": "Gateron",
      "switch_name": "Blue",
      "switch_type": "Clicky"
    },
    {
      "keyboard_id": 14,
      "vendor_id": 3,
      "switch_id": 22,
      "layout_id": 1,
      "name": "Ducky One 2",
      "release_date": "2018-08-30",
      "price": "129.99",
      "connectivity": "Wired",
      "hot_swappable": 0,
      "case_material": "Plastic",
      "weight": "1180.00",
      "vendor_name": "Kailh",
      "switch_name": "Ink Black",
      "switch_type": "Linear"
    },
    {
      "keyboard_id": 22,
      "vendor_id": 5,
      "switch_id": 40,
      "layout_id": 1,
      "name": "BlackWidow V3",
      "release_date": "2020-08-11",
      "price": "169.99",
      "connectivity": "Wired",
      "hot_swappable": 0,
      "case_material": "Aluminum",
      "weight": "1400.00",
      "vendor_name": "Razer",
      "switch_name": "Cream",
      "switch_type": "Linear"
    },
    {
      "keyboard_id": 26,
      "vendor_id": 6,
      "switch_id": 44,
      "layout_id": 1,
      "name": "G915",
      "release_date": "2019-08-26",
      "price": "249.99",
      "connectivity": "Both",
      "hot_swappable": 0,
      "case_material": "Aluminum",
      "weight": "1025.00",
      "vendor_name": "Logitech",
      "switch_name": "Blue",
      "switch_type": "Clicky"
    }
  ]
}
```


```
GET http://localhost/hw1/layouts/1/keyboards?connectivity=Wireless
```
Response:
```json
{
  "layout": {
    "layout_id": 1,
    "name": "Full Size",
    "description": "Standard full-size layout with numpad",
    "key_count": 104,
    "is_iso": 0
  },
  "meta": {
    "total": 0,
    "offset": 0,
    "current_page": 1,
    "page_size": 5,
    "total_pages": 0
  },
  "keyboards": []
}
```
## 7. Layout Keycap Sets Sub-Collection

### GET /layout/{layout_id}/keycap-sets
**Description:** Get keycap sets compatible with a specific layout.

**Basic Request:**
```
GET http://localhost/hw1/layouts/1/keycap-sets
```
Response:
```json
{
  "layout": {
    "layout_id": 1,
    "name": "Full Size",
    "description": "Standard full-size layout with numpad",
    "key_count": 104,
    "is_iso": 0
  },
  "meta": {
    "total": 17,
    "offset": 0,
    "current_page": 1,
    "page_size": 5,
    "total_pages": 4
  },
  "keycap_sets": [
    {
      "keycap_id": 1,
      "name": "GMK Olivia++",
      "material": "ABS",
      "profile": "Cherry",
      "manufacturer": "GMK",
      "price": "139.00",
      "release_date": "2020-11-15",
      "colorway": "Light Pink/Cream",
      "finish": "Glossy"
    },
    {
      "keycap_id": 2,
      "name": "GMK Botanical",
      "material": "ABS",
      "profile": "Cherry",
      "manufacturer": "GMK",
      "price": "135.00",
      "release_date": "2020-08-20",
      "colorway": "Green/Cream",
      "finish": "Glossy"
    },
    {
      "keycap_id": 3,
      "name": "GMK Dracula",
      "material": "ABS",
      "profile": "Cherry",
      "manufacturer": "GMK",
      "price": "129.00",
      "release_date": "2020-05-12",
      "colorway": "Purple/Pink",
      "finish": "Glossy"
    },
    {
      "keycap_id": 4,
      "name": "GMK Cafe",
      "material": "ABS",
      "profile": "Cherry",
      "manufacturer": "GMK",
      "price": "132.00",
      "release_date": "2019-12-08",
      "colorway": "Brown/Cream",
      "finish": "Glossy"
    },
    {
      "keycap_id": 5,
      "name": "GMK Hennessey",
      "material": "ABS",
      "profile": "Cherry",
      "manufacturer": "GMK",
      "price": "138.00",
      "release_date": "2021-03-25",
      "colorway": "Cognac/Gold",
      "finish": "Glossy"
    }
  ]
}
```

**With Filters:**
```
GET http://localhost/hw1/layouts/1/keycap-sets?material=PBT
```
Response:
```json
{
  "layout": {
    "layout_id": 1,
    "name": "Full Size",
    "description": "Standard full-size layout with numpad",
    "key_count": 104,
    "is_iso": 0
  },
  "meta": {
    "total": 11,
    "offset": 0,
    "current_page": 1,
    "page_size": 5,
    "total_pages": 3
  },
  "keycap_sets": [
    {
      "keycap_id": 6,
      "name": "SA Bliss",
      "material": "PBT",
      "profile": "SA",
      "manufacturer": "Signature Plastics",
      "price": "175.00",
      "release_date": "2019-09-14",
      "colorway": "Pink/Purple",
      "finish": "Matte"
    },
    {
      "keycap_id": 7,
      "name": "SA Godspeed",
      "material": "PBT",
      "profile": "SA",
      "manufacturer": "Signature Plastics",
      "price": "165.00",
      "release_date": "2018-06-30",
      "colorway": "Blue/Orange",
      "finish": "Matte"
    },
    {
      "keycap_id": 11,
      "name": "Cherry WoB",
      "material": "PBT",
      "profile": "Cherry",
      "manufacturer": "Cherry",
      "price": "45.00",
      "release_date": "2020-01-10",
      "colorway": "White/Black",
      "finish": "Matte"
    },
    {
      "keycap_id": 12,
      "name": "Akko ASA Neon",
      "material": "PBT",
      "profile": "ASA",
      "manufacturer": "Akko",
      "price": "39.99",
      "release_date": "2021-07-05",
      "colorway": "Cyan/Pink",
      "finish": "Matte"
    },
    {
      "keycap_id": 13,
      "name": "Akko Cherry Retro",
      "material": "PBT",
      "profile": "Cherry",
      "manufacturer": "Akko",
      "price": "35.99",
      "release_date": "2021-04-12",
      "colorway": "Beige/Brown",
      "finish": "Matte"
    }
  ]
}
```

```
GET http://localhost/hw1/layouts/1/keycap-sets?profile=Cherry
```
Response:
```json
{
  "layout": {
    "layout_id": 1,
    "name": "Full Size",
    "description": "Standard full-size layout with numpad",
    "key_count": 104,
    "is_iso": 0
  },
  "meta": {
    "total": 10,
    "offset": 0,
    "current_page": 1,
    "page_size": 5,
    "total_pages": 2
  },
  "keycap_sets": [
    {
      "keycap_id": 1,
      "name": "GMK Olivia++",
      "material": "ABS",
      "profile": "Cherry",
      "manufacturer": "GMK",
      "price": "139.00",
      "release_date": "2020-11-15",
      "colorway": "Light Pink/Cream",
      "finish": "Glossy"
    },
    {
      "keycap_id": 2,
      "name": "GMK Botanical",
      "material": "ABS",
      "profile": "Cherry",
      "manufacturer": "GMK",
      "price": "135.00",
      "release_date": "2020-08-20",
      "colorway": "Green/Cream",
      "finish": "Glossy"
    },
    {
      "keycap_id": 3,
      "name": "GMK Dracula",
      "material": "ABS",
      "profile": "Cherry",
      "manufacturer": "GMK",
      "price": "129.00",
      "release_date": "2020-05-12",
      "colorway": "Purple/Pink",
      "finish": "Glossy"
    },
    {
      "keycap_id": 4,
      "name": "GMK Cafe",
      "material": "ABS",
      "profile": "Cherry",
      "manufacturer": "GMK",
      "price": "132.00",
      "release_date": "2019-12-08",
      "colorway": "Brown/Cream",
      "finish": "Glossy"
    },
    {
      "keycap_id": 5,
      "name": "GMK Hennessey",
      "material": "ABS",
      "profile": "Cherry",
      "manufacturer": "GMK",
      "price": "138.00",
      "release_date": "2021-03-25",
      "colorway": "Cognac/Gold",
      "finish": "Glossy"
    }
  ]
}
```
```
GET http://localhost/hw1/layouts/1/keycap-sets?price_max=150
```
Response:
```json
{
  "layout": {
    "layout_id": 1,
    "name": "Full Size",
    "description": "Standard full-size layout with numpad",
    "key_count": 104,
    "is_iso": 0
  },
  "meta": {
    "total": 17,
    "offset": 0,
    "current_page": 1,
    "page_size": 5,
    "total_pages": 4
  },
  "keycap_sets": [
    {
      "keycap_id": 1,
      "name": "GMK Olivia++",
      "material": "ABS",
      "profile": "Cherry",
      "manufacturer": "GMK",
      "price": "139.00",
      "release_date": "2020-11-15",
      "colorway": "Light Pink/Cream",
      "finish": "Glossy"
    },
    {
      "keycap_id": 2,
      "name": "GMK Botanical",
      "material": "ABS",
      "profile": "Cherry",
      "manufacturer": "GMK",
      "price": "135.00",
      "release_date": "2020-08-20",
      "colorway": "Green/Cream",
      "finish": "Glossy"
    },
    {
      "keycap_id": 3,
      "name": "GMK Dracula",
      "material": "ABS",
      "profile": "Cherry",
      "manufacturer": "GMK",
      "price": "129.00",
      "release_date": "2020-05-12",
      "colorway": "Purple/Pink",
      "finish": "Glossy"
    },
    {
      "keycap_id": 4,
      "name": "GMK Cafe",
      "material": "ABS",
      "profile": "Cherry",
      "manufacturer": "GMK",
      "price": "132.00",
      "release_date": "2019-12-08",
      "colorway": "Brown/Cream",
      "finish": "Glossy"
    },
    {
      "keycap_id": 5,
      "name": "GMK Hennessey",
      "material": "ABS",
      "profile": "Cherry",
      "manufacturer": "GMK",
      "price": "138.00",
      "release_date": "2021-03-25",
      "colorway": "Cognac/Gold",
      "finish": "Glossy"
    }
  ]
}
```

```
GET http://localhost/hw1/layouts/1/keycap-sets?manufacturer=GMK
```
Response:
```json
{
  "layout": {
    "layout_id": 1,
    "name": "Full Size",
    "description": "Standard full-size layout with numpad",
    "key_count": 104,
    "is_iso": 0
  },
  "meta": {
    "total": 5,
    "offset": 0,
    "current_page": 1,
    "page_size": 5,
    "total_pages": 1
  },
  "keycap_sets": [
    {
      "keycap_id": 1,
      "name": "GMK Olivia++",
      "material": "ABS",
      "profile": "Cherry",
      "manufacturer": "GMK",
      "price": "139.00",
      "release_date": "2020-11-15",
      "colorway": "Light Pink/Cream",
      "finish": "Glossy"
    },
    {
      "keycap_id": 2,
      "name": "GMK Botanical",
      "material": "ABS",
      "profile": "Cherry",
      "manufacturer": "GMK",
      "price": "135.00",
      "release_date": "2020-08-20",
      "colorway": "Green/Cream",
      "finish": "Glossy"
    },
    {
      "keycap_id": 3,
      "name": "GMK Dracula",
      "material": "ABS",
      "profile": "Cherry",
      "manufacturer": "GMK",
      "price": "129.00",
      "release_date": "2020-05-12",
      "colorway": "Purple/Pink",
      "finish": "Glossy"
    },
    {
      "keycap_id": 4,
      "name": "GMK Cafe",
      "material": "ABS",
      "profile": "Cherry",
      "manufacturer": "GMK",
      "price": "132.00",
      "release_date": "2019-12-08",
      "colorway": "Brown/Cream",
      "finish": "Glossy"
    },
    {
      "keycap_id": 5,
      "name": "GMK Hennessey",
      "material": "ABS",
      "profile": "Cherry",
      "manufacturer": "GMK",
      "price": "138.00",
      "release_date": "2021-03-25",
      "colorway": "Cognac/Gold",
      "finish": "Glossy"
    }
  ]
}
```
