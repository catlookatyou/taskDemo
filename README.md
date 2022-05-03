## taskDemo

### 設計文件
[sd.pdf](https://github.com/catlookatyou/taskDemo/blob/main/TaskDemo%20%E8%A8%AD%E8%A8%88%E6%96%87%E4%BB%B6.pdf)

### 設計想法
登入後可使用api，在seeder中分了3個角色:新兵(rank=0)、上士(rank=1)、上校(rank=2)，並在controller中判斷是否符合角色權限，達成不同權限的api存取。  

不太確定「領域」資料為何? 猜測可能是api的scope，所以用了sanctum中的ability(類似passport的scope)，rank=2時給予check-confidential的能力，在middleware中區分能否使用此api。  
