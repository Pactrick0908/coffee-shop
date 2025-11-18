-- SQL to create database and tables for ql_quanan
CREATE DATABASE IF NOT EXISTS ql_quanan
CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE ql_quanan;

CREATE TABLE admin (
  id_admin INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL
);

CREATE TABLE douong (
  id_douong INT AUTO_INCREMENT PRIMARY KEY,
  ten VARCHAR(255) NOT NULL,
  gia DECIMAL(12,2) NOT NULL,
  loai VARCHAR(100),
  hinh_anh VARCHAR(255)
);

CREATE TABLE donhang (
  id_donhang INT AUTO_INCREMENT PRIMARY KEY,
  hoten_kh VARCHAR(255) NOT NULL,
  sdt VARCHAR(20),
  diachi VARCHAR(255),
  ngaydat DATETIME DEFAULT CURRENT_TIMESTAMP,
  tongtien DECIMAL(12,2) DEFAULT 0
);

CREATE TABLE chitietdonhang (
  id_chitiet INT AUTO_INCREMENT PRIMARY KEY,
  id_donhang INT NOT NULL,
  id_douong INT NOT NULL,
  soluong INT NOT NULL,
  thanhtien DECIMAL(12,2) NOT NULL,
  FOREIGN KEY (id_donhang) REFERENCES donhang(id_donhang) ON DELETE CASCADE,
  FOREIGN KEY (id_douong) REFERENCES douong(id_douong) ON DELETE RESTRICT
);
