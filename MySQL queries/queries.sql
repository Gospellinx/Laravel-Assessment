-- 1️⃣ Retrieve the Top 5 Customers with the Highest Total Spending

SELECT u.id, u.name, SUM(o.total_amount) AS total_spent
FROM orders o
JOIN users u ON o.user_id = u.id
GROUP BY u.id, u.name
ORDER BY total_spent DESC
LIMIT 5;

-- 2️⃣ Get the Total Revenue for the Current Month

SELECT SUM(total_amount) AS total_revenue
FROM orders
WHERE MONTH(created_at) = MONTH(CURRENT_DATE())
AND YEAR(created_at) = YEAR(CURRENT_DATE());

-- 3️⃣ List the Most Sold Products

SELECT p.id, p.name, SUM(oi.quantity) AS total_sold
FROM order_items oi
JOIN products p ON oi.product_id = p.id
GROUP BY p.id, p.name
ORDER BY total_sold DESC;

--Bonus: Get the Top 5 Most Sold Products

SELECT p.id, p.name, SUM(oi.quantity) AS total_sold
FROM order_items oi
JOIN products p ON oi.product_id = p.id
GROUP BY p.id, p.name
ORDER BY total_sold DESC
LIMIT 5;