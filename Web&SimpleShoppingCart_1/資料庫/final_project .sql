-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2022-12-15 06:40:26
-- 伺服器版本： 10.4.24-MariaDB
-- PHP 版本： 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `final_project`
--

-- --------------------------------------------------------

--
-- 資料表結構 `member`
--

CREATE TABLE `member` (
  `id` int(11) NOT NULL,
  `account` varchar(45) NOT NULL,
  `password` varchar(20) NOT NULL,
  `nickname` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `member`
--

INSERT INTO `member` (`id`, `account`, `password`, `nickname`) VALUES
(1, 'thomasleemingtai@gmail.com', 'Thomas1415926', 'Thomas'),
(2, 'aa@yahoo.com', 'a123', 'aa'),
(3, '1245', '123574', 'yee'),
(4, '1234', '458965', '1348');

-- --------------------------------------------------------

--
-- 資料表結構 `ordercontent`
--

CREATE TABLE `ordercontent` (
  `id` int(11) NOT NULL,
  `orderMember` int(11) NOT NULL,
  `time` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `orderlist`
--

CREATE TABLE `orderlist` (
  `id` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `quality` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `productName` varchar(50) NOT NULL,
  `imgLink` varchar(100) NOT NULL,
  `introduce` text DEFAULT NULL,
  `price` int(11) NOT NULL DEFAULT 0,
  `reserve` int(11) NOT NULL DEFAULT 0,
  `supplier` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `products`
--

INSERT INTO `products` (`id`, `productName`, `imgLink`, `introduce`, `price`, `reserve`, `supplier`) VALUES
(1, '教科書般的教科書', 'img/open-book.png', '    每年，我們都會推翻去年整出的那些內容，做一些細節上的修改，然後再告訴你們，這些修改後的內容很可能會出現在你們所處的那套應試教育測試機制中，並影響你們在這套體系中得到的評定。<br><br>\r\n    於是，你們就得去買今年新出的那套東西，而製造那些讀物的我們，便又可生存上一年了。<br><br>\r\n    或許在一百年後，那些觸動人們心靈的文學作品仍然會被銘記，而這一百年來的教材則會變成一版又一版的擦屁股紙。<br><br>\r\n    但無論如何，我們會繼續生存下去，只要你們獲取知識的途徑，仍然和這套令人反胃的測試系統捆綁在一起，你們終將是我們的小婊砸!!<br><br>\r\n<br>\r\n--驚悚樂園ch.845', 87, 999, 1),
(2, '喵星人的憤怒', 'img/cat-black-face.png', '喵喵喵喵喵喵，喵喵喵喵喵喵!!!!!!\r\n(埃爾溫·薛丁格是個渾蛋!!!!!!!)', 900, 12, 1),
(3, '梁靜茹給你的勇氣', 'img/fight.png', '當下次有人再度問你\"誰給你的勇氣??\"時，你終於可以理直氣壯的回答\"梁靜茹!\"。', 200, 66, 2),
(4, '用愛發的電', 'img/flash-lightning.png', '如果這東西真的存在，估計法拉第那幫科學家得從墳墓氣得跳出來!', 1450, 0, 3),
(5, '枯枝', 'img/twig.png', '樹大必有枯枝，人多必有白癡，<br>\r\n可以是可以，只是他們必須要自知!', 38, 999, 2),
(6, '仁', 'img/book-of-black-cover-closed.png', '子曰:\'仁\'就是把人一分為二的技術!!', 666, 55, 2),
(7, '反省的學問', 'img/thinking.png', '曾子曰\"吾日三省吾身，吾都發現是別人錯了!\"', 699, 31, 2),
(8, '白紙', 'img/document.png', '這就是一張白紙，但它訴說了所有人的憤怒，願我們能共同生活於平等自由的天空之下!', 0, 999999, 4),
(9, '忘憂國地圖', 'img/map.png', '還在拿著賣白菜的錢，操著賣白粉的心嗎??<br>去找把~我把所有的忘憂草(大麻)都種在那個地方!', 899, 100, 2),
(10, '像極了愛情', 'img/love.png', '孤單寂寞覺得冷?<br>\r\n抱著棉被趕緊滾!<br>\r\n.<br>\r\n.<br>\r\n.<br>\r\n像極了愛情!<br>', 1314520, 520, 2),
(11, '笑傲江湖', 'img/book-of-black-cover-closed.png', '我自橫刀向天笑，<br>\r\n笑完我就去睡覺，<br>\r\n睡醒我再拿起刀，<br>\r\n我又橫刀向天笑。<br>', 699, 1111, 2),
(12, '一缸金魚', 'img/fish-bowl.png', '你以為是要祝你金玉滿堂嗎?<br>\r\n不，她只是在說你\"好多魚!!!!\"', 1111, 333, 2);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `ordercontent`
--
ALTER TABLE `ordercontent`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `orderlist`
--
ALTER TABLE `orderlist`
  ADD PRIMARY KEY (`id`,`productId`);

--
-- 資料表索引 `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `ordercontent`
--
ALTER TABLE `ordercontent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
