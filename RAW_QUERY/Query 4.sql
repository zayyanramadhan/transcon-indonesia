select activities.title, activity_details.type ,SUM(activity_details.weight) as total_weight 
from activities left join activity_details on activities.id = activity_details.id_activity 
group by activities.id,activity_details.type order by activities.title asc;

SELECT a.title, COUNT(ad.id_activity) as total_detail_activity ,SUM(ad.weight) as total_weight
FROM activities a
JOIN (
    SELECT ad1.*
    FROM activity_details ad1
) ad ON a.id = ad.id_activity group by a.title;

SELECT a.title,
       COUNT(DISTINCT ad.type) AS total_types,
       SUM(ad.weight) AS total_weight
FROM activities a
JOIN activity_details ad ON a.id = ad.id_activity
GROUP BY a.title;	

SELECT a.title, ad.type, ad.weight
FROM activities a
JOIN (
    SELECT ad1.*
    FROM activity_details ad1
    JOIN (
        SELECT id_activity, MAX(id) as max_id
        FROM activity_details
        GROUP BY id_activity
    ) ad2 ON ad1.id = ad2.max_id
) ad ON a.id = ad.id_activity;