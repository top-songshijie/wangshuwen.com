var JWRestAction = {
    qryArticleList: function(b, a) {
        RestApiHelper.get("/article/page?" + $.param(b), a)
    },
    addArticleComment: function(a, c, b) {
        RestApiHelper.post("/article/" + a + "/comment", c, b)
    },
    addBulletinComment: function(a, c, b) {
        RestApiHelper.post("/bulletin/" + a + "/comment", c, b)
    }
};