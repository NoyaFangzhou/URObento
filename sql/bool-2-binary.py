with open('restaurant_info.dat') as f:
    lines = f.readlines()
    # cnt = 1
    o = open('restaurant_new_info.dat', 'w+')
    for i in lines:
        if i.find(" false,") < 0 :
           i = i.replace(" true,", " 0,")
        else:
            i = i.replace(" false,", " 1,")
        print i
        o.write(i)
    o.close()