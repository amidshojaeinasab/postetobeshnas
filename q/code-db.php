CREATE TABLE user_answers (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    user_id VARCHAR(100) NOT NULL,
    form_type VARCHAR(50) NOT NULL,
    question_code VARCHAR(20) NOT NULL,
    selected_value INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE INDEX idx_user_form ON user_answers(user_id, form_type);