
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
