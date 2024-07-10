select activities.title, activity_details.type ,SUM(activity_details.weight) as total_weight 
from activities left join activity_details on activities.id = activity_details.id_activity 
group by activities.id,activity_details.type order by activities.title asc;

SELECT a.title, COUNT(ad.id_activity) as total_detail_activity ,SUM(ad.weight) as total_weight
FROM activities a
JOIN (
    SELECT ad1.*
    FROM activity_details ad1
) ad ON a.id = ad.id_activity group by a.title;

SELECT a.title, COUNT(ad.type) as total_activity_type ,SUM(ad.weight) as total_weight
FROM activities a
JOIN (
    SELECT ad1.*
    FROM activity_details ad1
    JOIN (
        SELECT type, id
        FROM activity_details
        GROUP BY type, id
    ) ad2 ON ad1.id = ad2.id
) ad ON a.id = ad.id_activity group by a.title;


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