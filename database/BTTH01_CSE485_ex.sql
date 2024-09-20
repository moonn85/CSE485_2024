-- a, Liệt kê các bài viết về các bài hát thuộc thể loại Nhạc trữ tình
SELECT * FROM baiviet where ma_tloai = 2;

-- b, Liệt kê các bài viết của tác giả “Nhacvietplus”
SELECT * FROM baiviet LEFT JOIN tacgia ON baiviet.ma_tgia = tacgia.ma_tgia WHERE tacgia.ten_tgia = "Nhacvietplus";

-- c, Liệt kê các thể loại nhạc chưa có bài viết cảm nhận nào.
SELECT * from theloai as tl WHERE tl.ma_tloai NOT IN (SELECT bv.ma_tloai FROM baiviet as bv);

-- d, Liệt kê các bài viết với các thông tin sau: mã bài viết, tên bài viết, tên bài hát, tên tác giả, tên thể loại, ngày viết.
SELECT bv.ma_bviet as "mã bài viết", bv.ten_bhat as "tên bài hát", tg.ten_tgia as "tên tác giả", tl.ten_tloai as "tên thể loại", bv.ngayviet as "ngày viết" FROM baiviet as bv LEFT JOIN tacgia as tg ON tg.ma_tgia = bv.ma_tgia LEFT JOIN theloai as tl ON tl.ma_tloai = bv.ma_tloai;

-- e, Tìm thể loại có số bài viết nhiều nhất
SELECT theloai.*,COUNT(baiviet.ma_tloai) as "Số bài viết" FROM theloai
LEFT JOIN baiviet ON theloai.ma_tloai = baiviet.ma_tloai
GROUP BY theloai.ma_tloai, theloai.ten_tloai
ORDER BY COUNT(baiviet.ma_tloai) DESC
LIMIT 1

-- f, Liệt kê 2 tác giả có số bài viết nhiều nhất
SELECT tacgia.*,COUNT(baiviet.ma_tgia) as "Số bài viết" FROM tacgia
LEFT JOIN baiviet ON tacgia.ma_tgia = baiviet.ma_tgia
GROUP BY tacgia.ma_tgia, tacgia.ten_tgia, tacgia.hinh_tgia
ORDER BY COUNT(baiviet.ma_tgia) DESC
LIMIT 2

-- g, . Liệt kê các bài viết về các bài hát có tựa bài hát chứa 1 trong các từ “yêu”, “thương”, “anh”, “em”
SELECT baiviet.ma_bviet, baiviet.ten_bhat, tacgia.ten_tgia, baiviet.ngayviet, baiviet.hinhanh, baiviet.tomtat, baiviet.noidung, baiviet.ma_tloai FROM baiviet,tacgia WHERE baiviet.ten_bhat LIKE '%yêu%' OR baiviet.ten_bhat LIKE '%thương%' OR baiviet.ten_bhat LIKE '%anh%' OR baiviet.ten_bhat LIKE '%em%';

-- i,Tạo 1 view có tên vw_Music để hiển thị thông tin về Danh sách các bài viết kèm theo Tên  thể loại và tên tác giả
CREATE VIEW vw_Music AS
SELECT
    bv.ma_bviet,
    bv.tieude,
    bv.ten_bhat,
    tl.ten_tloai AS ten_the_loai,
    tg.ten_tgia AS ten_tac_gia
FROM
    baiviet bv
    JOIN theloai tl ON bv.ma_tloai = tl.ma_tloai
    JOIN tacgia tg ON bv.ma_tgia = tg.ma_tgia;
-- Xem view
SELECT * FROM vw_Music

-- j, Tạo 1 thủ tục có tên sp_DSBaiViet với tham số truyền vào là Tên thể loại và trả về danh sách Bài viết của thể loại đó. Nếu thể loại không tồn tại thì hiển thị thông báo lỗi.

-- k, Thêm mới cột SLBaiViet vào trong bảng theloai. Tạo 1 trigger có tên tg_CapNhatTheLoai để khi thêm/sửa/xóa bài viết thì số lượng bài viết trong bảng theloai được cập nhật theo.
-- Thêm mới cột SLBaiViet
ALTER TABLE theloai ADD COLUMN SLBaiViet INT DEFAULT 0;

DELIMITER //
CREATE TRIGGER tg_CapNhatTheLoai
AFTER INSERT ON baiviet
FOR EACH ROW
BEGIN
    -- Tăng số lượng bài viết trong thể loại khi 1 bài viết mới được thêm
    UPDATE theloai
    SET SLBaiViet = SLBaiViet + 1
    WHERE ma_tloai = NEW.ma_tloai;
END //
DELIMITER ;

-- Bổ sung thêm bảng Users để lưu thông tin Tài khoản đăng nhập
CREATE TABLE users (
id int not null primary key auto_increment,
fullname varchar(255) not null,
email varchar(255) not null,
username varchar(255) not null,
password varchar(255) not null,
role int(1) DEFAULT 0
);

-- password admin123
insert into users(email, fullname, username, password) values("admin@gmail.com", "Admin", "$2y$10$4styoFP49X.JsTbbE5QYnO8LUADCf7GNscHACW5O/Mcd78hVMzbDa");