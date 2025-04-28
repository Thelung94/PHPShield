# PHPShield

**Simple Lightweight PHP Application DoS/Rate Limiting Protection**

PHPShield is a pure PHP application-level protection system designed to help defend against small-scale DoS (Denial of Service) attacks and abusive traffic.  
It uses session-based rate limiting and basic IP blocking — no external firewall, proxy, or complex server configuration needed!

---

## ✨ Features

- Request rate limiting (per IP)
- Temporary IP blocking on abuse
- Lightweight (no database required)
- Easy to integrate (just `require_once 'protect.php'`)
- Pure PHP, no external dependencies

---

## 🚀 Installation

1. Download or clone the repository:

   ```bash
   git clone https://github.com/Thelung94/PHPShield.git
   copy folder PHPShield into htdoc or www
