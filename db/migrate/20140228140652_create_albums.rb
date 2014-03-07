class  CreateAlbums < ActiveRecord::Migration
  def up
    create_table :albums do |t|
      t.string :name
      
      t.datetime :created
      t.datetime :modified
    end
  end

  def down
    drop_table :albuns
  end
end