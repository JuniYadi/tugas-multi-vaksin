# Multi Vaksin

## Running

```
php -S localhost:8000
```

## Database

```sql
CREATE TABLE Pengguna (
    nik VARCHAR(255) PRIMARY KEY,
    nama VARCHAR(255),
    email VARCHAR(255),
    hp VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE Vaksin (
    kode VARCHAR(255) PRIMARY KEY,
    nama VARCHAR(255),
    dosis INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE RumahSakit (
    id_faskes VARCHAR(255) PRIMARY KEY,
    nama_faskes VARCHAR(255),
    alamat VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE CatatanVaksin (
    id INT PRIMARY KEY AUTO_INCREMENT,
    kode_vaksin VARCHAR(255),
    nik VARCHAR(255),
    tanggal DATE,
    dosis INT,
    id_faskes VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (kode_vaksin) REFERENCES Vaksin(kode),
    FOREIGN KEY (nik) REFERENCES Pengguna(nik),
    FOREIGN KEY (id_faskes) REFERENCES RumahSakit(id_faskes)
);


```