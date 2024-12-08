CREATE OR REPLACE USER 'db_user'@'localhost' IDENTIFIED BY 'password';

CREATE OR REPLACE DATABASE sugarrush;

GRANT SELECT, ALTER, CREATE,CREATE VIEW, DELETE, INDEX, INSERT, REFERENCES, SELECT, SHOW VIEW, TRIGGER, UPDATE, DROP on sugarrush.* to 'db_user'@'localhost';

USE sugarrush;

CREATE TABLE products (
    ProductID int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    ProductBrand varchar(255) NOT NULL,
    ProductName varchar(255) NOT NULL,
    ProductCategory varchar(255) NOT NULL,
    ProductImage varchar(255) NOT NULL,
    ProductWeight int NOT NULL,
    ProductPrice decimal(8, 2) NOT NULL,
    InStock int NOT NULL
);

/*
SweetCategory will be used in product filtering.
--Integer values in 'SweetWeight' represent grams, or milliliters when the product is a drink.
--Stock quantity may be implemented here. For now, a boolean '1' or '0' is used.
--InStock '1' = sufficient stock to order.
InStock '0' = insufficient stock to order.
*/

INSERT INTO products (ProductBrand, ProductName, ProductCategory, ProductImage, ProductWeight, ProductPrice, InStock)
VALUES
('Haribo', 'Starmix', 'Sweets', 'images/Sweets/Haribo-Starmix.avif', 175, 1.25, 1),
('Maynards Bassetts', 'Wine Gums', 'Sweets', 'images/Sweets/Maynards-Bassetts-Wine-Gums.avif', 130, 1.35, 1),
('Swizzels', 'Squashies', 'Sweets', 'images/Sweets/Swizzels-Squashies.avif', 140, 0.99, 1),
('Cadbury', 'Dairy Milk Buttons', 'Chocolate', 'images/Chocolate/Cadbury-Dairy-Milk-Buttons.avif', 119, 1.75, 1),
('Maynards Bassetts', 'Sherbet Lemons', 'Sweets', 'images/Sweets/Maynards-Bassetts-Sherbet-Lemons.webp', 192, 1.52, 1),
('Galaxy', 'Galaxy Cookies', 'Biscuits', 'images/Biscuits/Galaxy-Cookies.avif', 180, 1.35, 1),
('Oreo''s', 'Oreo Vanilla', 'Biscuits', 'images/Biscuits/Oreos.avif', 154, 0.90, 1),
('Cadbury', 'Dairy Milk', 'Chocolate', 'images/Chocolate/Dairy-Milk.avif', 180, 2.50, 1),
('Hersheys', 'Hershey''s Cookies N Creme', 'Chocolate', 'images/Chocolate/Hersheys-Cookies-N-Creme.webp', 90, 1.25, 1),
('Kinder', 'Kinder Bueno', 'Chocolate', 'images/Chocolate/Kinder-Bueno.avif', 43, 2.39, 1),
('Lindt', 'Lindt Chocolate', 'Chocolate', 'images/Chocolate/Lindt-Chocolate.avif', 100, 3.00, 1),
('Malteasers', 'Malteasers', 'Chocolate', 'images/Chocolate/Maltesers.avif', 214, 4.00, 1),
('Monster', 'Monster Energy', 'Drinks', 'images/Drinks/Monster.avif', 500, 1.90, 1),
('Red Bull', 'Red Bull Energy Drink', 'Drinks', 'images/Drinks/Red-Bull.avif', 355, 2.00, 1),
('Jacob''s', 'Mini Cheddars', 'Savoury', 'images/Savoury/Mini-Cheddars.avif', 138, 1.75, 1),
('Pringles', 'Pringles Original', 'Savoury', 'images/Savoury/Pringles.avif', 40, 1, 1),
('Kellog''s', 'Gooey Marshmallow Squares', 'Biscuits', 'images/Biscuits/Squares.avif', 144, 2.25, 1),
('Walkers', 'Ready Salted Walkers', 'Savoury', 'images/Savoury/Walkers.avif', 150, 2.00, 1),
('Rowntrees', 'Fruit Pastilles', 'Sweets', 'images/Sweets/Fruit-Pastilles.avif', 143, 1.50, 1),
('Skittles', 'Fruit Skittles', 'Sweets', 'images/Sweets/Skittles.avif', 143, 1.50, 1),
('Skittles', 'Sour Skittles', 'Sweets', 'images/Sweets/Sour-Skittles.avif', 143, 1.50, 1),
('Maynards Bassetts', 'Liquorice Allsorts', 'Sweets', 'images/Sweets/Maynards-Liqourice-Allsorts.avif', 350, 2.75, 1),
('McVitie''s', 'Jaffa Cakes', 'Biscuits', 'images/Biscuits/Jaffa-Cakes.avif', 220, 2.00, 1),
('Lotus', 'Lotus Biscoff', 'Biscuits', 'images/Biscuits/Lotus-Biscoff.avif', 220, 3.00, 1),
('McVitie''s', 'McVitie''s Digestives', 'Biscuits', 'images/Biscuits/Mcvities-Digestives.avif', 400, 3.00, 1),
('McVitie''s', 'McVitie''s Rich Tea Biscuits', 'Biscuits', 'images/Biscuits/Mcvities-Rich-Tea.avif', 400, 3.00, 1),
('Cadbury', 'Cadbury Boost', 'Chocolate', 'images/Chocolate/Cadbury-Boost.avif', 180, 2.25, 1),
('Cadbury', 'Flake', 'Chocolate', 'images/Chocolate/Cadbury-Flake.avif', 180, 2.25, 1),
('KitKat', 'KitKat Chunky', 'Chocolate', 'images/Chocolate/KitKat-Chunky.avif', 110, 2.25, 1),
('Nestle', 'Nestle After Eight', 'Chocolate', 'images/Chocolate/Nestle-After-Eight.avif', 200, 2.80, 1),
('Terry''s', 'Terry''s Chocolate Orange', 'Chocolate', 'images/Chocolate/Terrys-Chocolate-Orange.avif', 300, 1.80, 1),
('Robinsons', 'Fruit Shoot Apple and Blackcurrent', 'Drinks', 'images/Drinks/Fruit-Shoot-Apple-Blackcurrent.avif', 400, 1.80, 1),
('Tango', 'Tango Orange', 'Drinks', 'images/Drinks/Tango-Orange.avif', 400, 1.80, 1),
('Dairylea', 'Dairylea Dunkers', 'Savoury', 'images/Savoury/Dairylea-Dunkers.avif', 200, 1.20, 1),
('Doritos', 'Doritos Chilli Heatwave', 'Savoury', 'images/Savoury/Doritos-Chilli-Heatwave.avif', 200, 1.50, 1),
('Haribo', 'Haribo Supermix', 'Sweets', 'images/Sweets/Haribo-Supermix.avif', 180, 1.50, 1),
('Haribo', 'Haribo Tangfastics', 'Sweets', 'images/Sweets/Haribo-Tangfastics.avif', 180, 1.50, 1),
('Nerds', 'Nerds Gummy Clusters', 'Sweets', 'images/Sweets/Nerds-Gummy-Clusters.avif', 200, 1.70, 1),
('Rowntrees', 'Rowntrees Randoms', 'Sweets', 'images/Sweets/Rowntrees-Randoms.avif', 300, 1.70, 1),


('Sugar Rush', 'Blue and Pink Mix 1kg', 'Mix', 'images/Mix/Blue-Pink-Mix.jpg', 1000, 20.00, 1),
('Sugar Rush', 'Blue and Red Mix 1kg', 'Mix', 'images/Mix/Blue-Red-Mix.jpg', 1000, 20.00, 1),
('Sugar Rush', 'Red and Pink Mix 1kg', 'Mix', 'images/Mix/Red-Pink-Mix.jpg', 1000, 20.00, 1),
('Sugar Rush', 'Special Pack 1kg', 'Mix', 'images/Mix/Special-Pack.jpg', 1000, 25.00, 1),
('Sugar Rush', 'Cold Mix 1kg', 'Mix', 'images/Mix/Cold-Mix.jpg', 1000,15.00, 1),
('Sugar Rush', 'Fizzy Mix 1kg', 'Mix', 'images/Mix/Fizzy-Mix.jpg', 1000, 15.00, 1),
('Sugar Rush', 'Sour Mix 1kg', 'Mix', 'images/Mix/Fizzy-Mix.jpg', 1000, 15.00, 1),
('Sugar Rush', 'Drink Mix 1kg', 'Drinks', 'images/Mix/Chocolate-Mix.jpg', 1000, 25.00, 1);











CREATE TABLE product_descriptions (
    DescriptionID int NOT NULL PRIMARY KEY,
    DescriptionContent varchar(1000),
    Ingredients varchar(1000),
    CONSTRAINT fk_product_association
        FOREIGN KEY (DescriptionID)
        REFERENCES products (ProductID)
        ON DELETE CASCADE
);

INSERT INTO product_descriptions (DescriptionID, DescriptionContent, Ingredients)
VALUES
(1, "Fruit Flavour Gums with 2% Fruit Juice from Concentrate, Cola Flavour Gums and Sweet Foam Gums.", "Glucose Syrup, Sugar, Dextrose, Gelatine, Fruit Juice from Concentrate: Strawberry, Lemon, Apple, Blackcurrant, Orange, Pineapple, Acid: Citric Acid, Caramelised Sugar Syrup, Fruit and Plant Concentrates: Apple, Bilberry, Carrot, Safflower, Spirulina, Elderberry, Blackcurrant, Orange, Lemon, Mango, Passion Fruit, Aronia, Grape, Sunflower Oil, Flavouring, Glazing Agent: Beeswax, Elderberry Extract."),
(2, "Fruit flavour gums.", "Glucose Syrup, Sugar, Starch, Gelatine, Acids (Malic Acid, Acetic Acid, Citric Acid), Colours (Anthocyanins, Vegetable Carbon, Paprika Extract, Lutein, Curcumin), Coconut Oil, Flavourings, Glazing Agent (Carnauba Wax)."),
(3, "Raspberry and Milk Flavour Gums.", "Glucose Syrup, Sugar, Gelling Agent: Gelatine, Modified Starch, Acidity Regulators: Citric Acid, Trisodium Citrate, Flavourings, Pectin, Glazing Agent: Carnaubawax, Colour: Anthocyanin."),
(4, "Giant button shaped bites of our classic, creamy Cadbury Dairy Milk chocolate. A favourite for all the family to share and enjoy. Made with sustainably sourced cocoa. Vegetarian friendly. ", "Milk**, Sugar, Cocoa Butter, Cocoa Mass, Vegetable Fats (Palm, Shea), Emulsifier (E442), Flavourings, **The equivalent of 426 ml of Fresh Liquid Milk in every 227 g of Milk Chocolate, Milk Solids 20 % minimum, actual 23 %, Cocoa Solids 20 % minimum, Contains Vegetable Fats in addition to Cocoa Butter."),
(5, "Experience a citrus whirlwind with our Sherbet Lemons Sweets! The zesty lemon flavour combined with a fizzy sherbet centre makes for an unforgettable taste sensation.", "Sugar, Glucose Syrup, Citric Acid, Sodium Bicarbonate, Flavourings, Colour (Curcumin) Allergy Information: May Contain Milk, May Contain Nuts, May Contain Sesame Seeds, May Contain Soya\Soybeans, Contains Sulphur Dioxide/Sulphites."),
(6, "Crisp cookies containing milk chocolate chunks.", "Wheat Flour (Wheat Flour, Calcium Carbonate, Iron, Niacin, Thiamin), Milk Chocolate Chunks (30%) (Sugar, Cocoa Butter, Skimmed Milk Powder, Cocoa Mass, Lactose and Protein from Whey (from Milk), Palm Fat, Whey Powder (from Milk), Milk Fat, Emulsifier (Soya Lecithin), Vanilla Extract), Sugar, Palm Oil, Butter Oil (from Milk), Chocolate Powder (Sugar, Cocoa Butter, Skimmed Milk Powder, Cocoa Mass, Lactose and Protein from Whey (from Milk), Palm Fat, Whey Powder (from Milk), Milk Fat, Emulsifier (Soya Lecithin), Vanilla Extract), Partially Inverted Refiners Syrup, Whey or Whey Permeate (from Milk), Raising Agents (Sodium Bicarbonate, Ammonium Bicarbonate), Flavouring, Salt, Milk Chocolate contains Milk Solids 14% minimum and Cocoa Solids 25% Minimum, Milk Chocolate contains Vegetable Fats in Addition to Cocoa Butter."),
(7, "Chocolate Flavour Sandwich Biscuits with a Vanilla Flavour Filling (29 %).", "Wheat Flour, Sugar, Palm Oil, Rapeseed Oil, Fat Reduced Cocoa Powder 4.3%, Wheat Starch, Glucose-fructose Syrup, Raising Agents (Ammonium Carbonates, Potassium Carbonates, Sodium Carbonates), Salt, Emulsifier (Soya Lecithins), Acidity Regulator (Sodium Hydroxide), Flavouring."),
(8, "The one. The only. Made with a glass and a half of fresh milk from the British Isles and Ireland, for the classic, creamy taste that''s unmistakably Cadbury. ", "Milk**, Sugar, Cocoa Butter, Cocoa Mass, Vegetable Fats (Palm, Shea), Emulsifiers (E442, E476), Flavourings, **The equivalent of 426 ml of Fresh Liquid Milk in every 227 g of Milk Chocolate, Milk Solids 20 % minimum, actual 23 %, Cocoa Solids 20 % minimum, Contains Vegetable Fats in addition to Cocoa Butter."),
(9, "White Chocolate Flavour Candy (81%) with Cookies (19%).", "Sugar, Vegetable Oils (Palm, Sunflower, Palm Kernel), Skimmed Milk Powder, Corn Syrup Solids, Wheat Flour, Lactose (Milk), Cocoa Powder, Emulsifier (Soya Lecithin), Milk Powder, Raising Agent (E500ii), Cocoa Mass, Flavourings, *Compared to previous recipe (15% Cookies)."),
(10, "Milk Chocolate Covered Wafer with Smooth Milky and Hazelnut Filling.", "Milk Chocolate 31.5% (Sugar, Cocoa Butter, Cocoa Mass, Skimmed Milk Powder, Concentrated Butter, Emulsifier: Lecithins (Soya), Vanillin), Sugar, Palm Oil, Wheat Flour, Hazelnuts (10.5%), Skimmed Milk Powder, Whole Milk Powder, Chocolate (Sugar, Cocoa Mass, Cocoa Butter, Emulsifier: Lecithins (Soya), Vanillin), Fat-Reduced Cocoa, Emulsifier: Lecithins (Soya), Raising Agents (Sodium Bicarbonate, Ammonium Bicarbonate), Salt, Vanillin, Total Milk Constituents: 19.5%."),
(11, "Milk chocolate truffles with a smooth melting filling.", "Sugar, Vegetable Fat (Coconut, Palm Kernel), Cocoa Butter, Cocoa Mass, Whole MILK Powder, Skimmed MILK Powder, LACTOSE, Anhydrous MILK Fat, Emulsifier (SOYA Lecithin), BARLEY Malt Extract, Flavourings."),
(12, "Milk chocolate (73%) with a honeycombed centre (23%).", "Sugar, Skimmed Milk Powder, Cocoa Butter, Glucose Syrup, Barley Malt Extract, Cocoa Mass, Palm Fat, Whey Permeate (Milk), Milk Fat, Palm Kernel fat, Emulsifiers (Soya Lecithin, E492), Wheat Flour, Raising Agents (E341, E500, E501), Wheat Gluten, Sweet Whey Powder (from Milk), Salt, Glazing Agent (Pectins), Milk Chocolate contains Milk Solids 14% minimum, Milk Chocolate contains Vegetable Fats in addition to Cocoa Butter."),
(13, "Carbonated Energy Drink with Taurine, Ginseng, L-Carnitine, Caffeine and B Vitamins with Sugars and Sweetener.", "Carbonated Water, Sucrose, Glucose Syrup, Acid (Citric Acid), Flavourings, Taurine (0.4%), Acidity Regulator (Sodium Citrates), Panax Ginseng Root Extract (0.08%), L-Carnitine L-Tartrate (0.04%), Preservatives (Sorbic Acid, Benzoic Acid), Caffeine (0.03%), Colour (Anthocyanins), Vitamins (B3, B6, B2, B12), Sweetener (Sucralose), Sodium Chloride, D-Glucuronolactone, Guarana Seed Extract (0.002%), Inositol, Maltodextrin."),
(14, "Red Bull Energy Drink is appreciated worldwide by top athletes, students, and in highly demanding professions as well as during long drives.", "Water, Sucrose, Glucose, Acid (Citric Acid), Carbon Dioxide, Taurine (0.4 %), Acidity Regulators (Sodium Carbonates, Magnesium Carbonates), Caffeine (0.03 %), Vitamins (Niacin, Pantothenic Acid, B6, B12), Flavourings, Colours (Plain Caramel, Riboflavins)."),
(15, "We make every last bite awesome. So we sprinkle and stir real cheese into our dough. Then it''s baked (Never Fried!) until golden to guarantee cheesy, crunchy perfection, every time.", "Flour (Wheat Flour, Calcium, Iron, Niacin, Thiamin), Vegetable Oils (Palm, Sunflower), Dried Cheese (10%) (Milk) [Dried Powdered Cheese (Milk), Natural Flavouring], Sugar, Glucose Syrup, Salt, Dried Whey (Milk), Barley Malt Extract, Raising Agents (Ammonium Bicarbonate, Sodium Bicarbonate), Acid (Lactic Acid), Natural Flavourings."),
(16, "A classic flavour for a classic crisp, Pringles Original crisps, with their iconic appearance and instantly recognisable shape. These delectable crisps are perfect for any party, get together, or afternoon snack.", "Dehydrated Potatoes, Vegetable Oils (Sunflower, Palm Corn) in varying proportions, Wheat Flour, Corn Flour, Rice Flour, Maltodextrin, Emulsifier (E471), Salt, Colour (Annatto Norbixin)."),
(17, "Rice Cereal Bar with a Marshmallow Flavoured Coating.", "Kellogg''s Toasted Rice Cereal (35%) (Rice, Sugar, Salt, Barley Malt Extract, Niacin, Iron, Vitamin B6, Riboflavin, Thiamin, Folic Acid, Vitamin D, Vitamin B12), Marshmallow (33%) (Glucose Syrup, Sugar, Beef Gelatin, Flavouring), Fructose, Palm Oil, Invert Sugar Syrup, Glucose Syrup, Humectant (Glycerol), Salt, Flavouring (contains Milk), Emulsifiers (E472e, E472a), Antioxidant (E320)."),
(18, "100% Great British PotatoesSome See Potatoes, We See Potential.", "Potatoes, Vegetable Oils (Sunflower, Rapeseed, in varying proportions), Salt, Antioxidants (Rosemary Extract, Ascorbic Acid, Tocopherol Rich Extract, Citric Acid)."),
(19, "If you''re looking for a chewy, fruity-flavoured sweet, try the irresistible taste of Rowntree''s® Fruit Pastilles.", "Sugar, Glucose Syrup, Starch, Invert Sugar Syrup, Acids (Malic Acid, Citric Acid, Lactic Acid, Acetic Acid), Concentrated Fruit Juice (1.2%) (Apple, Blackcurrant, Lime, Orange, Strawberry, Lemon), Acidity Regulator (Trisodium Citrate), Flavourings, Colours (Anthocyanins, Copper Complexes of Chlorophyllins, Beta-Carotene, Curcumin)."),
(20, "Chewy Candies in a Crisp Sugar Shell with Fruit Flavours.", "Sugar, Glucose Syrup, Palm Fat, Acids (Citric Acid, Malic Acid), Dextrin, Maltodextrin, Flavourings, Modified Starch, Colours (E162, E163, E170, E160a, E100, E132, E133), Acidity Regulator (Trisodium Citrate), Glazing Agent (Carnauba Wax)."),
(21, "Chewy Candies in a Crisp Sugar Shell with Sour Fruit Flavours.", "Sugar, Glucose Syrup, Palm Fat, Acid (Citric Acid), Dextrin, Maltodextrin, Modified Starch, Flavourings, Colours (E163, E162, E170, E100, E132, E160a, E133), Acidity Regulator (Trisodium Citrate), Glazing Agent (Carnauba Wax), Concentrates (Sweet Potato, Radish)."),
(22, "Liquorice allsorts. May contain traces of liquorice.", "Sugar, Molasses, Glucose Syrup (contains Sulphites), Wheat Flour (with added Calcium, Niacin, Iron, Thiamin), Desiccated Coconut, Starch, Gelatine, Fat-Reduced Cocoa Powder, Liquorice Extract, Colours (Plain Caramel, Beetroot Red, Paprika Extract, Curcumin, Vegetable Carbon, Anthocyanins, Lutein), Caramel Sugar Syrup, Flavourings, Coconut Oil, Concentrated Vegetable Extract (Spirulina), Glazing Agent (Carnauba Wax)."),
(23, "20 Light Sponge Cakes with Dark Crackly Chocolate and a Tangy Orangey Centre.", "Glucose-Fructose Syrup, Dark Chocolate (19%) [Sugar, Cocoa Mass, Vegetable Fats (Palm, Shea), Butter Oil (Milk), Cocoa Butter, Emulsifiers (Soya Lecithin, E476), Natural Flavouring], Sugar, Flour (Wheat Flour, Calcium, Iron, Niacin, Thiamin), Whole Egg, Water, Dextrose, Concentrated Orange Juice, Glucose Syrup, Vegetable Oils (Sunflower, Palm), Humectant (Glycerine), Acid (Citric Acid), Gelling Agent (Pectin), Raising Agents (Disodium Diphosphate, Ammonium Bicarbonate, Sodium Bicarbonate), Dried Whole Egg, Acidity Regulator (Sodium Citrates), Natural Orange Flavouring, Colour (Curcumin), Emulsifier (Soya Lecithin), Product contains the equivalent of 8% Orange Juice."),
(24, "The Original Caramelised Biscuit.", "Wheat Flour, Sugar, Vegetable Oils (Palm*, Rapeseed), Candy Sugar Syrup, Raising Agent (Sodium Hydrogen Carbonate), Soya Flour, Salt, Cinnamon, *Palm Oil from Sustainable and Certified Plantations."),
(25, "Golden-baked to a secret recipe since 1892, McVitie’s original Digestives are loved for their classic crunch, distinctive, salty-sweet wheat flavour and true Britishness.", "Flour (55%) (Wheat Flour, Calcium, Iron, Niacin, Thiamin), Vegetable Oil (Palm), Wholemeal Wheat Flour (16%), Sugar, Partially Inverted Sugar Syrup, Raising Agents (Sodium Bicarbonate, Malic Acid, Ammonium Bicarbonate), Salt."),
(26, "Crafted with care to create a light, crisp, sweet biscuit, McVitie''s Rich Tea biscuits are a true British classic, and the gold standard for dunking in a cup of tea.", "Flour (Wheat Flour, Calcium, Iron, Niacin, Thiamin), Sugar, Vegetable Oil (Palm), Glucose-Fructose Syrup, Barley Malt Extract, Raising Agents (Sodium Bicarbonate, Ammonium Bicarbonate), Salt."),
(27, "Let’s taste our way from the inside out. Crunchy biscuit sits in a soft cocoa centre, those two are wrapped in deliciously chewy caramel, and that’s then finished off with a thick layer of Cadbury milk chocolate.", "Milk, Sugar, Vegetable Fats (Palm, Shea), Glucose Syrup, Whey Powder (from Milk), Cocoa Butter, Fat-Reduced Cocoa Powder, Skimmed Milk Powder, Cocoa Mass, Wheat Flour (with added Calcium, Iron, Niacin, Thiamin), Humectant (Glycerol), Emulsifiers (E442, E471, E476), Flavourings, Salt, Thickener (Cellulose), Raising Agents (Sodium Carbonates, Tartaric Acid), Barley Malt Syrup, Milk Chocolate: Milk Solids 14% minimum, Contains Vegetable Fats in addition to Cocoa Butter."),
(28, "The crumbliest, flakiest milk chocolate.", "Milk, Sugar, Cocoa Mass, Cocoa Butter, Whey Powder (from Milk), Vegetable Fats (Palm, Shea), Emulsifiers (E442, E476), Flavourings, Milk Solids 14 % minimum, Cocoa Solids 25 % minimum, Contains Vegetable Fats in addition to Cocoa Butter."),
(29, "Crispy wafer finger covered with thick milk chocolate (68%).", "Sugar, Wheat Flour (contains Calcium, Iron, Thiamin and Niacin), Whole Milk Powder, Cocoa Mass, Cocoa Butter, Vegetable Fats (Palm, Shea, Sal), Whey Powder Product (Milk), Skimmed Milk Powder, Emulsifier (Lecithins), Yeast, Raising Agent (Sodium Bicarbonate), Glucose Syrup, Butterfat (Milk), Whey Powder (Milk), Natural Flavourings."),
(30, "Dark chocolates with peppermint flavoured fondant cream centre.", "Sugar, Cocoa Mass, Glucose Syrup, Vegetable Fats (Palm, Shea, Palm Kernel), Cocoa Butter, Butterfat (Milk), Emulsifier (Lecithins), Stabliser (Invertase), Natural Peppermint Oil, Acid (Citric Acid), Dark Chocolate contains Vegetable Fat in addition to Cocoa Butter."),
(31, "Milk chocolate flavoured with real orange oil.", "Sugar, Cocoa Mass, Cocoa Butter, Skimmed Milk Powder, Whey Powder (from Milk), Vegetable Fats (Palm, Shea), Milk Fat, Emulsifiers (Soya Lecithins, E476), Orange Oil, Flavouring, Milk Solids 14 % minimum, Cocoa Solids 25 % minimum, Contains Vegetable Fats in addition to Cocoa Butter."),
(32, "Low Calorie Apple and Blackcurrant Soft Drink with Sweeteners.", "Water, Fruit Juices from Concentrate (Apple 6%, Blackcurrant 2%), Acid (Citric Acid), Natural Flavourings, Acidity Regulator (Sodium Citrate), Carrot and Blueberry Concentrate, Antioxidant (Ascorbic Acid), Sweeteners (Acesulfame K, Sucralose)."),
(33, "Carbonated Orange Soft Drink with Sugar and Sweeteners.", "Carbonated Water, Orange Fruit from Concentrate (5%), Sugar, Acids (Citric Acid, Malic Acid), Acidity Regulator (Sodium Citrate), Natural Orange Flavouring, Sweeteners (Aspartame, Saccharin), Preservative (Potassium Sorbate), Antioxidant (Ascorbic Acid), Stabiliser (Pectin), Natural Colour (Carotenes), Emulsifiers (Acacia Gum, Glycerol Esters of Wood Rosins)."),
(34, "Cheese dip (7 % fat) with added calcium and corn & potato snack (29 %).", "Dairylea Cheese Dip: Skimmed Milk (Water, Skimmed Milk Powder), Cheese, Concentrated Whey (from Milk), Inulin, Milk Protein, Milk Fat, Emulsifying Salt (Polyphosphates), Modified Starch, Calcium Phosphate, Acidity Regulator (Lactic Acid), Corn and Potato Snack: Corn Flour, Potato Granules, Palm Oil, Flavourings, Sugar, Salt, Onion Powder, Emulsifier (Mono- and Diglycerides of Fatty Acids), Yeast Extract, Garlic Powder, Parsley, Acid (Citric Acid), Rosemary, Horseradish."),
(35, "Chilli Heatwave Flavour Corn Chips", "Corn (Maize), Rapeseed Oil, Chilli Heatwave Flavour [sugar, Flavourings, Flavour Enhancers (Monosodium Glutamate, Disodium Guanylate), Potassium Chloride, Hydrolysed Vegetable Protein, Salt, Garlic Powder, Paprika Powder, Onion Powder, Acid (Citric Acid), Cayenne Pepper, Colour (Paprika Extract)], Antioxidants (Rosemary Extract, Ascorbic Acid, Tocopherol Rich Extract, Citric Acid)."),
(36, "Fruit and Milk Flavour Gums with Sweet Foam Gums.", "Glucose Syrup, Sugar, Gelatine, Dextrose, Acid: Citric Acid, Fruit and Plant Concentrates: Apple, Aronia, Beetroot, Bilberry, Blackcurrant, Carrot, Elderberry, Grape, Lemon, Mango, Orange, Passion Fruit, Radish, Safflower, Spirulina, Sweet Potato, Sunflower Oil, Flavouring, Glazing Agent: Beeswax, Caramelised Sugar Syrup, Elderberry Extract."),
(37, "Fizzy Fruit Flavour, Cola Flavour and Sweet Foam Gums.", "Glucose Syrup, Sugar, Gelatine, Dextrose, Acids: Citric Acid, Malic Acid, Acidity Regulators: Calcium Citrates, Sodium Hydrogen Malate, Caramelised Sugar Syrup, Fruit and Plant Concentrates: Apple, Aronia, Blackcurrant, Carrot, Elderberry, Grape, Hibiscus, Kiwi, Lemon, Mango, Orange, Passion Fruit, Safflower, Spirulina, Flavouring, Elderberry Extract, Glazing Agent: Carnauba Wax."),
(38, "Nerds Candy SWTS Gummy CLSTRS Fruits 113g.", "Glucose Syrup*, Sugar, Dextrose, Gelatine (Pork), Modified Maize Starch*, Acids (Malic Acid, Citric Acid), Water, Acidity Regulator (Sodium Citrate), Concentrated Fruit Juices (Apple, Watermelon), Plant and Vegetable Concentrates (Black Carrot, Spirulina, Red Radish), Flavourings, Thickener (Gum Arabic), Glazing Agent (Carnauba Wax), Colour (Curcumin), *Contains Glucose Syrup and Starch From Genetically Modified Maize."),
(39, "Assorted Fruit Flavoured Jellies.", "Glucose Syrup, Sugar, Gelatine, Concentrated Fruit Juices (1.3%) (Apple, Blueberry, Black Carrot, Orange, Lemon, Raspberry, Mandarin, Strawberry), Acids (Citric Acid, Malic Acid, Tartaric Acid, Lactic Acid, Acetic Acid), Fructose, Humectant (Glycerol), Vegetable Oils (Palm, Coconut, Rapeseed), Fruit and Vegetable Concentrates (Black Carrot, Carrot, Safflower, Hibiscus), Natural Flavourings, Acidity Regulators (Sodium Ascorbate, Sodium Citrate), Stabilisers (Carageenan, Locust Bean Gum), Salt, Spirulina Concentrate, Glazing Agent (Carnauba Wax), Invert Sugar Syrup, Colours (Paprika Extract, Beta-Carotene, Chlorophylls and Chloropyllins, Curcumin)."),
(40, "A mixture of sour sweets.", "Glucose Syrup, Sugar, Gelatine, Dextrose, Acids: Citric Acid, Malic Acid, Acidity Regulators: Calcium Citrates, Sodium Hydrogen Malate, Caramelised Sugar Syrup, Fruit and Plant Concentrates: Apple, Aronia, Blackcurrant, Carrot, Elderberry, Grape, Hibiscus, Kiwi, Lemon, Mango, Orange, Passion Fruit, Safflower, Spirulina, Flavouring, Elderberry Extract, Glazing Agent: Carnauba Wax."),
(41, "A mixture of hard sweets.", "Glucose Syrup, Sugar, Gelling Agent: Gelatine, Modified Starch, Acidity Regulators: Citric Acid, Trisodium Citrate, Flavourings, Pectin, Glazing Agent: Carnaubawax, Colour: Anthocyanin."),
(42, "A mixture of liquorice sweets.", "Sugar, Molasses, Glucose Syrup (contains Sulphites), Wheat Flour (with added Calcium, Niacin, Iron, Thiamin), Desiccated Coconut, Starch, Gelatine, Fat-Reduced Cocoa Powder, Liquorice Extract, Colours (Plain Caramel, Beetroot Red, Paprika Extract, Curcumin, Vegetable Carbon, Anthocyanins, Lutein), Caramel Sugar Syrup, Flavourings, Coconut Oil, Concentrated Vegetable Extract (Spirulina), Glazing Agent (Carnauba Wax).");

/* CREATION OF USER ACCOUNTS TABLE */

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2024 at 01:19 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

/*
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
*/

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sugarrush`
--

-- --------------------------------------------------------

--
-- Table structure for table `userid`
--

CREATE TABLE userid (
    id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    firstname varchar(30) NOT NULL,
    lastname varchar(30) NOT NULL,
    email varchar(75) NOT NULL,
    password varchar(75) NOT NULL,
    admin tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `userid` (`id`, `firstname`, `lastname`, `email`, `password`, `admin`) VALUES
(1, 'Admin', 'Account', 'admin@admin.com', '$2y$10$UjH0ueH4My0PHPREOXChi.wFcKBIr3QbsAR8mH95kps7QqvPBXND6', 1); -- Email: admin@admin.com, Password: admin123!

--
-- Indexes for dumped tables
--

--
-- Indexes for table `userid`
--

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;