CREATE VIEW `students` 
AS 
SELECT U.*, S.*, SHU.*
FROM user AS U, student AS S, student_has_user AS SHU
WHERE U.username = SHU.user_username 
	AND S.student_id = SHU.student_student_id