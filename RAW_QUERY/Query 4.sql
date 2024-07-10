
select activities.title, activity_details.type ,SUM(activity_details.weight) as total_weight 
from activities left join activity_details on activities.id = activity_details.id_activity 
group by activities.idorder by activities.title asc

select activities.title, COUNT(activity_details.id_activity) as total_detail_activity ,SUM(activity_details.weight) as total_weight 
from activities left join activity_details on activities.id = activity_details.id_activity 
group by activities.id, activity_details.type order by activities.title asc


select activities.title, COUNT(DISTINCT activity_details.id_activity) as total_detail_activity ,SUM(activity_details.weight) as total_weight 
from activities left join activity_details on activities.id = activity_details.id_activity 
group by activities.id, activity_details.type order by activities.title asc


select distinct activities.title, activity_details.type ,SUM(activity_details.weight) as total_weight 
from activities left join activity_details on activities.id = activity_details.id_activity 
group by activities.title, activity_details.type limit 2