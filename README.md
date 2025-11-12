# 🗳️ Bincom PHP Developer Test (Laravel Solution)

A Laravel 10 implementation of the **Bincom ICT Election Data Test**, using the provided `bincom_test.sql` dataset (2011 election results).  
Developed as part of the Bincom Developer Recruitment Assessment.

---

## 📂 Project Overview

The project showcases Laravel MVC proficiency by solving three core problems:

1. **Display Polling Unit Results**  
   View the detailed results of any polling unit by party.

2. **Summed LGA Results**  
   Select an LGA and view the **aggregated vote totals** from all polling units under it.

3. **Add New Polling Unit Result**  
   Input results for all parties with a **chained dropdown** (State → LGA → Ward → Polling Unit).  
   Results are timestamped and associated with the submitting user.

---

## 🛠️ Tech Stack

- **Laravel 10 + PHP 8**
- **MySQL / phpMyAdmin (Laragon)**
- **Bootstrap 5** for responsive UI
- **SweetAlert2** for polished notifications
- **Vite** for asset compilation

---

## ⚙️ Setup Instructions

1. Clone this repository:
   ```bash
   git clone https://github.com/Aloydeachieve/bincom_laravel_test.git
   cd bincom_laravel_test
