# 酒鬼專案

- 紀錄自己喝過什麼、評分

- 哪些店家有什麼好喝的桶裝啤酒






# todolist: 1st stage

### model 
- [x] users 用戶資料 
- [x] brewerys 釀酒廠/店家資訊
- [x] items 不同酒廠酒類品項/清單




### CRUD 

| api  | users  |brewerys   |   items|
|---------|:---:|:---:|:---:|
| register/create |  o  | o |  o  | 
| login      |  o  |  o | n/a  |
| read/showOne  |  o  |  o    |   left join/ show brewerys' name  | 
| showAll  |  n/a  |   o  |  n/a  | 
| update/edit  |   |  o  |  edit item name   | 
| delete  |   |  50%  |   o   | 
| logout  |   |    |    n/a  | 
| token /expire  |  o |   o  |  n/a     | 






## database 規劃
https://dbdiagram.io/d/5f096d6d0425da461f048851



# todoslist 2nd stage
## model
- [ ] history 個人飲用紀錄
- [ ] orders

##  api
- [ ] 購物車 (僅發送訂購、不串金流)
- [ ] 整合三方登入
- [ ] 上傳圖片
- [ ] 單隻啤酒的總評分
- [ ] 釀酒廠/店家資訊的總評分
- [ ] deploy GCP 

